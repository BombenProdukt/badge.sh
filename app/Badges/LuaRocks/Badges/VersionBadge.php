<?php

declare(strict_types=1);

namespace App\Badges\LuaRocks\Badges;

use App\Badges\AbstractBadge;
use App\Badges\LuaRocks\Client;
use App\Enums\Category;
use Composer\Semver\Comparator;
use Illuminate\Routing\Route;

final class VersionBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $user, string $moduleName, ?string $version = null): array
    {
        return $this->renderVersion($this->latestVersion($this->client->get($user, $moduleName)));
    }

    public function service(): string
    {
        return 'LuaRocks';
    }

    public function keywords(): array
    {
        return [Category::VERSION];
    }

    public function routePaths(): array
    {
        return [
            '/luarocks/version/{user}/{moduleName}/{version?}',
        ];
    }

    public function routeParameters(): array
    {
        return [];
    }

    public function routeConstraints(Route $route): void
    {
        //
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/luarocks/version/mpeterv/luacheck' => 'version',
        ];
    }

    private function latestVersion(array $versions): ?string
    {
        return collect($versions)
            ->keys()
            ->map(fn ($version) => str_starts_with($version, 'v') ? substr($version, 1) : $version)
            ->sort(fn ($a, $b) => Comparator::greaterThan($this->parseVersion($b), $this->parseVersion($a)))
            ->first();
    }

    private function parseVersion(string $versionString): string
    {
        return explode('-', $versionString)[0];
    }
}
