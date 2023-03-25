<?php

declare(strict_types=1);

namespace App\Badges\CRAN\Badges;

use App\Enums\Category;

final class WeeklyDownloadsBadge extends AbstractBadge
{
    protected array $routes = [
        '/cran/downloads-weekly/{package}',
    ];

    protected array $keywords = [
        Category::DOWNLOADS,
    ];

    public function handle(string $package): array
    {
        return [
            'downloads' => $this->client->logs("downloads/total/last-week/{$package}")[0]['downloads'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderDownloadsPerWeek($properties['downloads']);
    }

    public function previews(): array
    {
        return [
            '/cran/downloads-weekly/Rcpp' => 'weekly downloads',
        ];
    }
}
