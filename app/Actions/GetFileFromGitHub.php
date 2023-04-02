<?php

declare(strict_types=1);

namespace App\Actions;

use Github\Client;
use GrahamCampbell\GitHub\Facades\GitHub;
use Symfony\Component\Yaml\Yaml;

final class GetFileFromGitHub
{
    public static function raw(string $owner, string $repo, string $file): string
    {
        /** @var Client */
        $connection = GitHub::connection();

        return \base64_decode($connection->repos()->contents()->show($owner, $repo, $file)['content'], true);
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
