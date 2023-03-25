<?php

declare(strict_types=1);

namespace App\Badges\VCPKG\Badges;

use App\Enums\Category;

final class VersionBadge extends AbstractBadge
{
    protected array $routes = [
        '/vcpkg/version/{packageName}',
    ];

    protected array $keywords = [
        Category::VERSION,
    ];

    public function handle(string $packageName): array
    {
        $response = $this->client->get($packageName);

        if (isset($manifest['version-date'])) {
            return [
                'version' => $response['version-date'],
            ];
        }

        if (isset($manifest['version-semver'])) {
            return [
                'version' => $response['version-semver'],
            ];
        }

        if (isset($manifest['version-string'])) {
            return [
                'version' => $response['version-string'],
            ];
        }

        return [
            'version' => $response['version'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderVersion($properties['version']);
    }

    public function previews(): array
    {
        return [
            '/vcpkg/version/entt' => 'version',
        ];
    }
}
