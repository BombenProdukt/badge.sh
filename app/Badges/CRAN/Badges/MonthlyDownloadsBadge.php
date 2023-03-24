<?php

declare(strict_types=1);

namespace App\Badges\CRAN\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class MonthlyDownloadsBadge extends AbstractBadge
{
    public function handle(string $package): array
    {
        return $this->renderDownloadsPerMonth($this->client->logs("downloads/total/last-month/{$package}")[0]['downloads']);
    }

    public function keywords(): array
    {
        return [Category::DOWNLOADS];
    }

    public function routePaths(): array
    {
        return [
            '/cran/downloads-monthly/{package}',
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
            '/cran/downloads-monthly/Rcpp' => 'monthly downloads',
        ];
    }
}
