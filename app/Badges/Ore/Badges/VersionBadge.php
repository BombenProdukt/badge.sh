<?php

declare(strict_types=1);

namespace App\Badges\Ore\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class VersionBadge extends AbstractBadge
{
    protected array $routes = [
        '/ore/version/{pluginId}',
    ];

    protected array $keywords = [
        Category::VERSION,
    ];

    public function handle(string $pluginId): array
    {
        return $this->client->get($pluginId)['promotedVersions'][0];
    }

    public function render(array $properties): array
    {
        return $this->renderVersion($properties['version']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'version',
                path: '/ore/version/nucleus',
                data: $this->render([]),
            ),
        ];
    }
}
