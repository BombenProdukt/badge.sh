<?php

declare(strict_types=1);

namespace App\Badges\CRAN\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class MonthlyDownloadsBadge extends AbstractBadge
{
    protected array $routes = [
        '/cran/downloads-monthly/{package}',
    ];

    protected array $keywords = [
        Category::DOWNLOADS,
    ];

    public function handle(string $package): array
    {
        return $this->client->logs("downloads/total/last-month/{$package}")[0];
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
                path: '/cran/downloads-monthly/Rcpp',
                data: $this->render([]),
            ),
        ];
    }
}
