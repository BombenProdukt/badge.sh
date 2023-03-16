<?php

declare(strict_types=1);

namespace App\Integrations\WinGet;

use GrahamCampbell\GitHub\Facades\GitHub;

final class Client
{
    public function get(string $appId): array
    {
        return GitHub::connection()->api('repo')->contents()->show('microsoft', 'winget-pkgs', "manifests/{$this->getPath($appId)}/{$this->version($appId)}/{$appId}.yaml");
    }

    public function version(string $appId): string
    {
        $versions = GitHub::connection()->api('repo')->contents()->show('microsoft', 'winget-pkgs', "manifests/{$this->getPath($appId)}");

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
