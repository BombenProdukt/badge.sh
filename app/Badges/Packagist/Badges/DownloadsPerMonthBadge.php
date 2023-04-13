<?php

declare(strict_types=1);

namespace App\Badges\Packagist\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class DownloadsPerMonthBadge extends AbstractBadge
{
    protected string $route = '/packagist/downloads-monthly/{vendor}/{project}';

    protected array $keywords = [
        Category::DOWNLOADS,
    ];

    public function handle(string $vendor, string $project): array
    {
        return [
            'downloads' => $this->client->get($vendor, $project)['downloads']['monthly'],
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
                name: 'monthly downloads',
                path: '/packagist/downloads-monthly/monolog/monolog',
                data: $this->render(['downloads' => '1000000']),
            ),
        ];
    }
}
