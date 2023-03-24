<?php

declare(strict_types=1);

namespace App\Badges\CRAN\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class DailyDownloadsBadge extends AbstractBadge
{
    public function handle(string $package): array
    {
        return $this->client->logs("downloads/total/last-day/{$package}")[0];
    }

    public function render(array $properties): array
    {
        return $this->renderDownloadsPerDay($properties['downloads']);
    }

    public function keywords(): array
    {
        return [Category::DOWNLOADS];
    }

    public function routePaths(): array
    {
        return [
            '/cran/downloads-daily/{package}',
        ];
    }

    public function routeParameters(): array
    {
        return [];
    }

    public function routeConstraints(Route $route): void
    {
        //
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/cran/downloads-daily/Rcpp' => 'daily downloads',
        ];
    }
}
