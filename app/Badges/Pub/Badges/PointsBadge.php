<?php

declare(strict_types=1);

namespace App\Badges\Pub\Badges;

use App\Badges\Pub\Client;
use App\Contracts\Badge;
use Illuminate\Routing\Route;

final class PointsBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $package): array
    {
        $response = $this->client->api("packages/{$package}/score");

        return [
            'label'       => 'popularity',
            'status'      => $response['grantedPoints'].'/'.$response['maxPoints'],
            'statusColor' => 'green.600',
        ];
    }

    public function service(): string
    {
        return 'Pub';
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
            '/pub/points/{package}',
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
            '/pub/points/rxdart' => 'pub points',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
