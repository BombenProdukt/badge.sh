<?php

declare(strict_types=1);

namespace App\Actions;

use Gitlab\Client;
use GrahamCampbell\GitLab\Facades\GitLab;
use Symfony\Component\Yaml\Yaml;

final class GetFileFromGitLab
{
    public static function raw(string $owner, string $repo, string $file): string
    {
        /** @var Client */
        $connection = GitLab::connection();

        return \base64_decode($connection->repositoryFiles()->getFile("{$owner}/{$repo}", $file, 'master')['content'], true);
    }

    public static function json(string $owner, string $repo, string $file): array
    {
        return \json_decode(self::raw($owner, $repo, $file), true, \JSON_THROW_ON_ERROR);
    }

    public static function yaml(string $owner, string $repo, string $file): array
    {
        return Yaml::parse(self::raw($owner, $repo, $file));
    }
}
