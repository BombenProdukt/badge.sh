<?php

declare(strict_types=1);

namespace App\Badges\CTAN\Badges;

use App\Badges\CTAN\Client;
use App\Contracts\Badge;
use Illuminate\Routing\Route;

final class RatingBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $package): array
    {
        preg_match('/<span>[^<]*?([\d.]+)\s/i', $this->client->web($package), $matches);

        return [
            'label'       => 'rating',
            'status'      => number_format((float) $matches[1], 2).'/5',
            'statusColor' => 'green.600',
        ];
    }

    public function service(): string
    {
        return 'CTAN';
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
            '/ctan/{package}/rating',
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
            '/ctan/pgf-pie/rating' => 'rating',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
