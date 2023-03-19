<?php

declare(strict_types=1);

namespace App\Badges\CRAN\Badges;

use App\Badges\CRAN\Client;
use App\Badges\Templates\DownloadsPerWeekTemplate;
use App\Contracts\Badge;
use Illuminate\Routing\Route;

final class WeeklyDownloadsBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $package): array
    {
        return DownloadsPerWeekTemplate::make($this->client->logs("downloads/total/last-week/{$package}")[0]['downloads']);
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
        return [
            //
        ];
    }

    public function routePaths(): array
    {
        return [
            '/cran/{package}/downloads/weekly',
        ];
    }

    public function routeParameters(): array
    {
        return [
            //
        ];
    }

    public function routeConstraints(Route $route): void
    {
        //
    }

    public function staticPreviews(): array
    {
        return [
            //
        ];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/cran/Rcpp/downloads/weekly' => 'weekly downloads',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
