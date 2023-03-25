<?php

declare(strict_types=1);

namespace App\Badges\CRAN\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class DailyDownloadsBadge extends AbstractBadge
{
    protected array $routes = [
        '/cran/downloads-daily/{package}',
    ];

    protected array $keywords = [
        Category::DOWNLOADS,
    ];

    public function handle(string $package): array
    {
        return $this->client->logs("downloads/total/last-day/{$package}")[0];
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
                path: '/cran/downloads-daily/Rcpp',
                data: $this->render([]),
            ),
        ];
    }
}
