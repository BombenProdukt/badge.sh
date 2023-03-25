<?php

declare(strict_types=1);

namespace App\Badges\DUB\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class DailyDownloadsBadge extends AbstractBadge
{
    protected array $routes = [
        '/dub/downloads-daily/{package}',
    ];

    protected array $keywords = [
        Category::DOWNLOADS,
    ];

    public function handle(string $package): array
    {
        return $this->client->get("{$package}/stats");
    }

    public function render(array $properties): array
    {
        return $this->renderDownloadsPerDay($properties['downloads']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'daily downloads',
                path: '/dub/downloads-daily/vibe-d',
                data: $this->render([]),
            ),
        ];
    }
}
