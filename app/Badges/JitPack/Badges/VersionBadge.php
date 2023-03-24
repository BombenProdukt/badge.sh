<?php

declare(strict_types=1);

namespace App\Badges\JitPack\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class VersionBadge extends AbstractBadge
{
    public function handle(string $groupId, string $artifactId): array
    {
        return [
            'version' => $this->client->version($groupId, $artifactId),
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderVersion($properties['version']);
    }

    public function keywords(): array
    {
        return [Category::VERSION];
    }

    public function routePaths(): array
    {
        return [
            '/jitpack/version/{groupId}/{artifactId}',
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
            '/jitpack/version/com.github.jitpack/maven-simple' => 'version',
        ];
    }
}
