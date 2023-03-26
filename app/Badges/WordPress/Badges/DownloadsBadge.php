<?php

declare(strict_types=1);

namespace App\Badges\WordPress\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class DownloadsBadge extends AbstractBadge
{
    protected array $routes = [
        '/wordpress/{extensionType:plugin,theme}/downloads/{extension}',
    ];

    protected array $keywords = [
        Category::DOWNLOADS,
    ];

    public function handle(string $extensionType, string $extension): array
    {
        return [
            'downloads' => $this->client->downloads($extensionType, $extension),
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
                name: 'total downloads (plugin)',
                path: '/wordpress/plugin/downloads/bbpress',
                data: $this->render(['downloads' => '1000000']),
            ),
            new BadgePreviewData(
                name: 'total downloads (theme)',
                path: '/wordpress/theme/downloads/twentyseventeen',
                data: $this->render(['downloads' => '1000000']),
            ),
        ];
    }
}
