<?php

declare(strict_types=1);

namespace App\Badges\Packagist\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class DownloadsPerDayBadge extends AbstractBadge
{
    protected string $route = '/packagist/downloads-daily/{vendor}/{project}';

    protected array $keywords = [
        Category::DOWNLOADS,
    ];

    public function handle(string $vendor, string $project): array
    {
        return [
            'downloads' => $this->client->get($vendor, $project)['downloads']['daily'],
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
                name: 'daily downloads',
                path: '/packagist/downloads-daily/monolog/monolog',
                data: $this->render(['downloads' => '1000000']),
            ),
        ];
    }
}
