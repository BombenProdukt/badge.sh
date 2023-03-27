<?php

declare(strict_types=1);

namespace App\Badges\WordPress\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class DownloadsPerQuarter extends AbstractBadge
{
    protected string $route = '/wordpress/{extensionType:plugin,theme}/downloads-quarterly/{extension}';

    protected array $keywords = [
        Category::DOWNLOADS,
    ];

    public function handle(string $extensionType, string $extension): array
    {
        return $this->renderDownloads($this->client->downloads($extensionType, $extension, 90));
    }

    public function render(array $properties): array
    {
        return $this->renderDownloads($properties['downloads']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'quarterly downloads (plugin)',
                path: '/wordpress/plugin/downloads-quarterly/bbpress',
                data: $this->render(['downloads' => 1000]),
            ),
            new BadgePreviewData(
                name: 'quarterly downloads (theme)',
                path: '/wordpress/theme/downloads-quarterly/twentyseventeen',
                data: $this->render(['downloads' => 1000]),
            ),
        ];
    }
}
