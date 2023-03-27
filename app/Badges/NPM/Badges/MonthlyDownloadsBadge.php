<?php

declare(strict_types=1);

namespace App\Badges\NPM\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class MonthlyDownloadsBadge extends AbstractBadge
{
    protected string $route = '/npm/downloads-monthly/{package:packageWithScope}/{tag?}';

    protected array $keywords = [
        Category::DOWNLOADS,
    ];

    public function handle(string $package, string $tag = 'latest'): array
    {
        return $this->client->api("downloads/point/last-month/{$package}");
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
                path: '/npm/downloads-monthly/express',
                data: $this->render(['downloads' => '1000000']),
            ),
        ];
    }
}
