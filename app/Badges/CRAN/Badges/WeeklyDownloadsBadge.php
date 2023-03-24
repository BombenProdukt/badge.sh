<?php

declare(strict_types=1);

namespace App\Badges\CRAN\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class WeeklyDownloadsBadge extends AbstractBadge
{
    public function handle(string $package): array
    {
        return $this->renderDownloadsPerWeek($this->client->logs("downloads/total/last-week/{$package}")[0]['downloads']);
    }

    public function keywords(): array
    {
        return [Category::DOWNLOADS];
    }

    public function routePaths(): array
    {
        return [
            '/cran/downloads-weekly/{package}',
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
            '/cran/downloads-weekly/Rcpp' => 'weekly downloads',
        ];
    }
}
