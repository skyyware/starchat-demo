<?php
declare(strict_types=1);

require_once dirname(__DIR__) . '/src/ProjectReleases.php';

return static function (?\Starchat\ProjectRequest $request): \Starchat\ProjectEnvironment {
    $runtime = getenv('STARCHAT_RUNTIME') ?: dirname(__DIR__) . '/.runtime/app';
    return (new \StageDemo\ProjectReleases($runtime))->environment(new DateTimeImmutable('now', new DateTimeZone('Europe/Berlin')), $request === null);
};
