<?php

declare(strict_types=1);

namespace App\Badges\VCPKG\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class VersionBadge extends AbstractBadge
{
    public function handle(string $packageName): array
    {
        $response = $this->client->get($packageName);

        if (isset($manifest['version-date'])) {
            return $this->renderVersion($response['version-date']);
        }

        if (isset($manifest['version-semver'])) {
            return $this->renderVersion($response['version-semver']);
        }

        if (isset($manifest['version-string'])) {
            return $this->renderVersion($response['version-string']);
        }

        return $this->renderVersion($response['version']);
    }

    public function keywords(): array
    {
        return [Category::VERSION];
    }

    public function routePaths(): array
    {
        return [
            '/vcpkg/version/{packageName}',
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
            '/vcpkg/version/entt' => 'version',
        ];
    }
}
