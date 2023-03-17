<?php

declare(strict_types=1);

namespace App\Integrations\WinGet;

use Github\Api\Repository\Contents;
use GrahamCampbell\GitHub\Facades\GitHub;

final class Client
{
    private readonly Contents $client;

    public function __construct()
    {
        $this->client = GitHub::connection()->api('repo')->contents();
    }

    public function get(string $appId): array
    {
        return $this->client->show('microsoft', 'winget-pkgs', "manifests/{$this->getPath($appId)}/{$this->version($appId)}/{$appId}.yaml");
    }

    public function locale(string $appId, string $version, string $locale): array
    {
        return $this->client->show('microsoft', 'winget-pkgs', "manifests/{$this->getPath($appId)}/{$version}/{$appId}.locale.{$locale}.yaml");
    }

    public function version(string $appId): string
    {
        $versions = $this->client->show('microsoft', 'winget-pkgs', "manifests/{$this->getPath($appId)}");

        return collect($versions)
            ->map(fn ($version) => new Version($version['name']))
            ->sort(fn (Version $a, Version $b) => Version::comparator($a, $b))
            ->last()
            ->toString();
    }

    private function getPath(string $appId): string
    {
        return strtolower(substr($appId, 0, 1)).'/'.str_replace('.', '/', $appId);
    }
}
