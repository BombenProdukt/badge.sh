<?php

declare(strict_types=1);

namespace App\Badges\WordPress\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class DownloadsPerWeekBadge extends AbstractBadge
{
    protected string $route = '/wordpress/{extensionType:plugin,theme}/downloads-weekly/{extension}';

    protected array $keywords = [
        Category::DOWNLOADS,
    ];

    public function handle(string $extensionType, string $extension): array
    {
        return [
            'downloads' => $this->client->downloads($extensionType, $extension, 7),
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderDownloads($properties['downloads']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'weekly downloads (plugin)',
                path: '/wordpress/plugin/downloads-weekly/bbpress',
                data: $this->render(['downloads' => '1000000']),
            ),
            new BadgePreviewData(
                name: 'weekly downloads (theme)',
                path: '/wordpress/theme/downloads-weekly/twentyseventeen',
                data: $this->render(['downloads' => '1000000']),
            ),
        ];
    }
}
