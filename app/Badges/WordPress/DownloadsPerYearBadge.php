<?php

declare(strict_types=1);

namespace App\Badges\WordPress;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class DownloadsPerYearBadge extends AbstractBadge
{
    protected string $route = '/wordpress/{extensionType:plugin,theme}/downloads-yearly/{extension}';

    protected array $keywords = [
        Category::DOWNLOADS,
    ];

    public function handle(string $extensionType, string $extension): array
    {
        return [
            'downloads' => $this->client->downloads($extensionType, $extension, 365),
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
                name: 'yearly downloads (plugin)',
                path: '/wordpress/plugin/downloads-yearly/bbpress',
                data: $this->render(['downloads' => '1000000']),
            ),
            new BadgePreviewData(
                name: 'yearly downloads (theme)',
                path: '/wordpress/theme/downloads-yearly/twentyseventeen',
                data: $this->render(['downloads' => '1000000']),
            ),
        ];
    }
}
