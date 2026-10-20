<?php
declare(strict_types=1);

namespace StageDemo;

use Starchat\Project;

final class ProjectPolicy
{
    public static function accepts(Project $project): bool
    {
        $files = array_column($project->data['files'], 'content', 'path');
        try {
            $composer = json_decode($files['composer.json'] ?? '', true, flags: JSON_THROW_ON_ERROR);
            if (($composer['require']['skyyware/stage'] ?? null) !== '^0.2'
                || ($composer['require']['php'] ?? null) !== '^8.4'
                || ($composer['config']['allow-plugins'] ?? null) !== false
                || isset($composer['repositories'])
                || ($composer['scripts']['start'] ?? null) !== '@php -S 127.0.0.1:8080 -t public public/index.php') {
                return false;
            }
            $entry = "<?php\ndeclare(strict_types=1);\nrequire dirname(__DIR__) . '/vendor/autoload.php';\n(require dirname(__DIR__) . '/app.php')->run();\n";
            if (self::tokens($files['public/index.php'] ?? '') !== self::tokens($entry)) { return false; }
            $tokens = self::tokens($files['app.php'] ?? '');
            $depth = 0;
            $returns = [];
            foreach ($tokens as $index => $token) {
                if (in_array($token, ['{', '(', '['], true)) { $depth++; }
                if (in_array($token, ['}', ')', ']'], true)) { $depth--; }
                if ($depth === 0 && is_array($token) && $token[0] === T_RETURN) { $returns[] = $index; }
            }
            if (count($returns) !== 1) { return false; }
            $return = array_slice($tokens, $returns[0]);
            if (($return[1][0] ?? null) !== T_NEW
                || ($return[2][0] ?? null) !== T_NAME_FULLY_QUALIFIED
                || strcasecmp($return[2][1], '\\Stage\\Http\\Application') !== 0
                || ($return[3] ?? null) !== '(') {
                return false;
            }
            $depth = 0;
            foreach (array_slice($return, 3) as $index => $token) {
                if ($token === '(') { $depth++; }
                if ($token === ')' && --$depth === 0) {
                    return array_slice($return, $index + 4) === [';'];
                }
            }
        } catch (\JsonException | \ParseError) {
            return false;
        }
        return false;
    }

    private static function tokens(string $source): array
    {
        return array_values(array_map(
            static fn (array|string $token): array|string => is_array($token) ? [$token[0], $token[0] === T_OPEN_TAG ? '<?php' : $token[1]] : $token,
            array_filter(token_get_all($source, TOKEN_PARSE), static fn (array|string $token): bool => !is_array($token) || !in_array($token[0], [T_WHITESPACE, T_COMMENT, T_DOC_COMMENT], true)),
        ));
    }
}
