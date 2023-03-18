<?php

declare(strict_types=1);

namespace App\Badges\CRAN\Badges;

use App\Badges\CRAN\Client;
use App\Contracts\Badge;
use Illuminate\Routing\Route;

final class LicenseBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $package): array
    {
        $response = $this->client->db($package);

        return [
            'label'       => 'license',
            'status'      => preg_replace('/\s*\S\s+file\s+LICEN[CS]E$/i', '', $response['License']),
            'statusColor' => 'blue.600',
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
            '/cran/license/{package}',
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
            '/cran/license/ggplot2' => 'license',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
