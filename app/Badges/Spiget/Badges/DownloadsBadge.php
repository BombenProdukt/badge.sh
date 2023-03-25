<?php

declare(strict_types=1);

namespace App\Badges\Spiget\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class DownloadsBadge extends AbstractBadge
{
    protected array $routes = [
        '/spiget/downloads/{resourceId}',
    ];

    protected array $keywords = [
        Category::DOWNLOADS,
    ];

    public function handle(string $resourceId): array
    {
        return $this->client->latestVersion($resourceId);
    }

    public function render(array $properties): array
    {
        return $this->renderDownloads($properties['downloads']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'downloads',
                path: '/spiget/downloads/9089',
                data: $this->render([]),
            ),
        ];
    }
}
