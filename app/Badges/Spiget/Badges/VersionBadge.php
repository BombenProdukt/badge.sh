<?php

declare(strict_types=1);

namespace App\Badges\Spiget\Badges;

use App\Enums\Category;

final class VersionBadge extends AbstractBadge
{
    protected array $routes = [
        '/spiget/version/{resourceId}',
    ];

    protected array $keywords = [
        Category::VERSION,
    ];

    public function handle(string $resourceId): array
    {
        return [
            'version' => $this->client->latestVersion($resourceId)['name'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderVersion($properties['version']);
    }

    public function previews(): array
    {
        return [
            '/spiget/version/9089' => 'version',
        ];
    }
}
