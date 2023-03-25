<?php

declare(strict_types=1);

namespace App\Badges\JitPack\Badges;

use App\Enums\Category;

final class VersionBadge extends AbstractBadge
{
    protected array $routes = [
        '/jitpack/version/{groupId}/{artifactId}',
    ];

    protected array $keywords = [
        Category::VERSION,
    ];

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
