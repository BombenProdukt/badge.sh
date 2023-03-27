<?php

declare(strict_types=1);

namespace App\Badges\WordPress\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class DownloadsPerDayBadge extends AbstractBadge
{
    protected string $route = '/wordpress/{extensionType:plugin,theme}/downloads-daily/{extension}';

    protected array $keywords = [
        Category::DOWNLOADS,
    ];

    public function handle(string $extensionType, string $extension): array
    {
        return [
            'downloads' => $this->client->downloads($extensionType, $extension, 1),
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderDownloadsPerDay($properties['downloads']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'daily downloads (plugin)',
                path: '/wordpress/plugin/downloads-daily/bbpress',
                data: $this->render(['downloads' => '1000000']),
            ),
            new BadgePreviewData(
                name: 'daily downloads (theme)',
                path: '/wordpress/theme/downloads-daily/twentyseventeen',
                data: $this->render(['downloads' => '1000000']),
            ),
        ];
    }
}
