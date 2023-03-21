<?php

declare(strict_types=1);

namespace App\Badges\CRAN\Badges;

use App\Badges\AbstractBadge;
use App\Badges\CRAN\Client;
use App\Badges\Templates\DownloadsPerMonthTemplate;
use Illuminate\Routing\Route;

final class MonthlyDownloadsBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $package): array
    {
        return DownloadsPerMonthTemplate::make($this->client->logs("downloads/total/last-month/{$package}")[0]['downloads']);
    }

    public function service(): string
    {
        return 'CRAN';
    }

    public function title(): string
    {
        return '';
    }

    public function keywords(): array
    {
        return [];
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
