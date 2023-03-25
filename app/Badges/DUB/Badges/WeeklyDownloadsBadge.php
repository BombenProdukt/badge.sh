<?php

declare(strict_types=1);

namespace App\Badges\DUB\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class WeeklyDownloadsBadge extends AbstractBadge
{
    protected array $routes = [
        '/dub/downloads-weekly/{package}',
    ];

    protected array $keywords = [
        Category::DOWNLOADS,
    ];

    public function handle(string $package): array
    {
        return [
            'downloads' => $this->client->get("{$package}/stats")['downloads']['weekly'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderDownloadsPerWeek($properties['downloads']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'weekly downloads',
                path: '/dub/downloads-weekly/vibe-d',
                data: $this->render(['downloads' => '1000000']),
            ),
        ];
    }
}
