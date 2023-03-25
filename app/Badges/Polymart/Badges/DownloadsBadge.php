<?php

declare(strict_types=1);

namespace App\Badges\Polymart\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class DownloadsBadge extends AbstractBadge
{
    protected array $routes = [
        '/polymart/downloads/{resourceId}',
    ];

    protected array $keywords = [
        Category::DOWNLOADS,
    ];

    public function handle(string $resourceId): array
    {
        return $this->client->get($resourceId);
    }

    public function render(array $properties): array
    {
        return $this->renderDownloads($properties['downloads']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'total downloads',
                path: '/polymart/downloads/323',
                data: $this->render([]),
            ),
        ];
    }
}
