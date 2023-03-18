<?php

declare(strict_types=1);

namespace App\Badges\CRAN\Badges;

use App\Actions\FormatNumber;
use App\Badges\CRAN\Client;
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
        return [
            'label'       => 'downloads',
            'status'      => FormatNumber::execute($this->client->logs("downloads/total/last-week/{$package}")[0]['downloads']).'/week',
            'statusColor' => 'green.600',
        ];
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
            '/cran/dw/{package}',
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
            '/cran/dw/Rcpp' => 'weekly downloads',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
