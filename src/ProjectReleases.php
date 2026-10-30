<?php
declare(strict_types=1);

namespace StageDemo;

use Closure;
use DateTimeImmutable;
use RuntimeException;
use Starchat\Project;
use Starchat\ProjectEnvironment;

final class ProjectReleases
{
    private const string STAGE_URL = 'https://packagist.org/packages/skyyware/stage.json';
    private const string PHP_URL = 'https://www.php.net/releases/index.php?json';

    public function __construct(private string $runtime, private ?Closure $fetch = null) {}

    public function environment(DateTimeImmutable $now, bool $starter = false): ProjectEnvironment
    {
        $snapshot = $this->snapshot($now);
        $versions = $snapshot['stage']['package']['versions'];
        $stable = array_filter($versions, static fn (array $release): bool => preg_match('/^v?[0-9]+\.[0-9]+\.[0-9]+$/D', $release['version'] ?? '') === 1);
        uasort($stable, static fn (array $a, array $b): int => version_compare(ltrim($b['version'], 'v'), ltrim($a['version'], 'v')));
        $latest = reset($stable);
        if (!$latest || !str_starts_with(ltrim($latest['version'], 'v'), '0.2.')) { throw new RuntimeException('Current Stage release needs compatibility verification'); }
        $stable = array_values(array_filter($stable, static fn (array $release): bool => str_starts_with(ltrim($release['version'], 'v'), '0.2.')));
        $php = $snapshot['php']['8'] ?? null;
        if (!is_array($php) || !preg_match('/^8\.[4-9]\.[0-9]+$/D', $php['version'] ?? '') || !is_array($php['supported_versions'] ?? null)) {
            throw new RuntimeException('Current compatible PHP release is unverified');
        }
        $data = [
            'checked_on' => $snapshot['checked_on'],
            'stage' => ['default' => ltrim($latest['version'], 'v'), 'versions' => array_map(static fn (array $release): string => ltrim($release['version'], 'v'), $stable), 'source' => self::STAGE_URL],
            'php' => ['default' => $php['version'], 'supported' => array_values(array_filter($php['supported_versions'], static fn (string $version): bool => preg_match('/^8\.[4-9]$/D', $version) === 1)), 'source' => self::PHP_URL],
            'frontend' => ['html', 'css', 'javascript'],
            'prepared_files' => ['composer.lock', 'docs/technology.json'],
        ];
        return new ProjectEnvironment($data, static fn (Project $project): Project => self::prepare($project, $stable, $data, $starter), reservedBytes: 4096);
    }

    private function snapshot(DateTimeImmutable $now): array
    {
        if (!is_dir($this->runtime) && !mkdir($this->runtime, 0700, true)) { throw new RuntimeException('Release cache is unavailable'); }
        $lock = fopen($this->runtime . '/project-releases.lock', 'c');
        if ($lock === false || !flock($lock, LOCK_EX)) { throw new RuntimeException('Release cache is unavailable'); }
        try {
            $path = $this->runtime . '/project-releases.json';
            $cached = is_file($path) && filesize($path) <= 2097152 ? json_decode(file_get_contents($path), true) : null;
            $date = $now->format('Y-m-d');
            if (is_array($cached) && ($cached['checked_on'] ?? null) === $date && isset($cached['stage']['package']['versions'], $cached['php']['8'])) { return $cached; }
            $fetch = $this->fetch ?? self::fetch(...);
            $stage = json_decode($fetch(self::STAGE_URL), true, 32, JSON_THROW_ON_ERROR);
            $php = json_decode($fetch(self::PHP_URL), true, 16, JSON_THROW_ON_ERROR);
            if (!is_array($stage['package']['versions'] ?? null) || ($stage['package']['name'] ?? null) !== 'skyyware/stage' || !is_array($php['8'] ?? null)) {
                throw new RuntimeException('Invalid official release metadata');
            }
            $snapshot = ['checked_on' => $date, 'stage' => $stage, 'php' => $php];
            $temporary = tempnam($this->runtime, 'project-releases-');
            if ($temporary === false) { throw new RuntimeException('Release cache is unavailable'); }
            try {
                chmod($temporary, 0600);
                if (file_put_contents($temporary, json_encode($snapshot, JSON_THROW_ON_ERROR)) === false || !rename($temporary, $path)) { throw new RuntimeException('Release cache is unavailable'); }
            } finally {
                if (is_file($temporary)) { unlink($temporary); }
            }
            return $snapshot;
        } finally {
            flock($lock, LOCK_UN);
            fclose($lock);
        }
    }

    private static function fetch(string $url): string
    {
        $context = stream_context_create(['http' => ['timeout' => 3, 'follow_location' => 0, 'header' => "Accept: application/json\r\nUser-Agent: Stage-project-releases\r\n"]]);
        $stream = @fopen($url, 'r', false, $context);
        if ($stream === false) { throw new RuntimeException('Official release metadata is unavailable'); }
        try {
            $body = stream_get_contents($stream, 1048577);
            $metadata = stream_get_meta_data($stream);
            if ($body === false || strlen($body) > 1048576 || ($metadata['timed_out'] ?? false) || !preg_match('~^HTTP/\S+ 200(?: |$)~', $metadata['wrapper_data'][0] ?? '')) {
                throw new RuntimeException('Official release metadata is unavailable');
            }
            return $body;
        } finally { fclose($stream); }
    }

    private static function prepare(Project $project, array $releases, array $evidence, bool $starter): Project
    {
        $files = array_column($project->data['files'], 'content', 'path');
        $composer = json_decode($files['composer.json'] ?? '', true, 16, JSON_THROW_ON_ERROR);
        if ($starter) {
            $composer['require']['php'] = '^' . implode('.', array_slice(explode('.', $evidence['php']['default']), 0, 2));
            $composer['require']['skyyware/stage'] = $evidence['stage']['default'];
        }
        $require = $composer['require'] ?? [];
        $constraint = $require['skyyware/stage'] ?? '';
        if (!is_string($constraint) || !preg_match('/^(\^|~)?(0\.2(?:\.[0-9]+)?)$/D', $constraint, $match)
            || !is_string($require['php'] ?? null) || !in_array(substr($require['php'], 1), $evidence['php']['supported'], true) || !str_starts_with($require['php'], '^')
            || ($composer['require-dev'] ?? []) !== [] || isset($composer['repositories']) || isset($composer['config']['platform'])
            || array_any(array_keys($require), static fn (string $package): bool => !in_array($package, ['php', 'skyyware/stage'], true) && !str_starts_with($package, 'ext-'))) {
            throw new RuntimeException('Project requires unverified dependency choices');
        }
        $minimum = substr_count($match[2], '.') === 1 ? $match[2] . '.0' : $match[2];
        $release = array_find($releases, static fn (array $release): bool => version_compare(ltrim($release['version'], 'v'), $minimum, ($match[1] ?? '') === '' ? '==' : '>='));
        if ($release === null || ($release['source']['url'] ?? null) !== 'https://github.com/skyyware/stage.git'
            || !preg_match('/^[a-f0-9]{40}$/D', $release['source']['reference'] ?? '')
            || ($release['require'] ?? null) !== ['php' => '^8.4', 'ext-json' => '*']
            || ($release['dist']['reference'] ?? null) !== $release['source']['reference']
            || ($release['dist']['url'] ?? null) !== 'https://api.github.com/repos/skyyware/stage/zipball/' . $release['source']['reference']) {
            throw new RuntimeException('Selected Stage release needs dependency verification');
        }
        $composer['require']['skyyware/stage'] = ltrim($release['version'], 'v');
        $files['composer.json'] = self::json($composer);
        $hashFields = array_intersect_key($composer, array_flip(['name', 'version', 'require', 'require-dev', 'conflict', 'replace', 'provide', 'minimum-stability', 'prefer-stable', 'repositories', 'extra']));
        foreach (['platform', 'policy'] as $key) {
            if (isset($composer['config'][$key])) { $hashFields['config'][$key] = $composer['config'][$key]; }
        }
        ksort($hashFields);
        $package = array_intersect_key($release, array_flip(['name', 'version', 'source', 'dist', 'require', 'type', 'autoload', 'license', 'description', 'homepage', 'support', 'funding', 'time']));
        $lock = ['content-hash' => md5(json_encode($hashFields, JSON_THROW_ON_ERROR)), 'packages' => [$package], 'packages-dev' => [], 'aliases' => [], 'minimum-stability' => $composer['minimum-stability'] ?? 'stable', 'stability-flags' => new \stdClass(), 'prefer-stable' => $composer['prefer-stable'] ?? false, 'prefer-lowest' => false, 'platform' => array_diff_key($composer['require'], ['skyyware/stage' => true]), 'platform-dev' => new \stdClass()];
        $files['composer.lock'] = self::json($lock);
        $files['docs/technology.json'] = self::json($evidence + ['selected' => ['stage' => $composer['require']['skyyware/stage'], 'stage_reference' => $release['source']['reference'], 'php_requirement' => $require['php']]]);
        $data = $project->data;
        $data['files'] = array_map(static fn (string $path, string $content): array => ['path' => $path, 'content' => $content], array_keys($files), array_values($files));
        return new Project($data);
    }

    private static function json(array $data): string
    {
        return json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR) . "\n";
    }
}
