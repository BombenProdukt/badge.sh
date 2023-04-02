<?php

declare(strict_types=1);

namespace App\Actions;

use Bitbucket\Client;
use GrahamCampbell\Bitbucket\Facades\Bitbucket;
use Symfony\Component\Yaml\Yaml;

final class GetFileFromBitbucket
{
    public static function raw(string $owner, string $repo, string $file): string
    {
        /** @var Client */
        $connection = Bitbucket::connection();

        return $connection->repositories()->workspaces($owner)->src($repo)->download('master', $file)->__toString();
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
