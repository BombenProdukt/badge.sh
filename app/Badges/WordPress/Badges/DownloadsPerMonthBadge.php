<?php

declare(strict_types=1);

namespace App\Badges\WordPress\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class DownloadsPerMonthBadge extends AbstractBadge
{
    protected string $route = '/wordpress/{extensionType:plugin,theme}/downloads-monthly/{extension}';

    protected array $keywords = [
        Category::DOWNLOADS,
    ];

    public function handle(string $extensionType, string $extension): array
    {
        return [
            'downloads' => $this->client->downloads($extensionType, $extension, 30),
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderDownloadsPerMonth($properties['downloads']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'monthly downloads (plugin)',
                path: '/wordpress/plugin/downloads-monthly/bbpress',
                data: $this->render(['downloads' => '1000000']),
            ),
            new BadgePreviewData(
                name: 'monthly downloads (theme)',
                path: '/wordpress/theme/downloads-monthly/twentyseventeen',
                data: $this->render(['downloads' => '1000000']),
            ),
        ];
    }
}
