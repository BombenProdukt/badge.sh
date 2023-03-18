<?php

declare(strict_types=1);

namespace App\Badges\OpenVSX\Badges;

use App\Badges\OpenVSX\Client;
use App\Contracts\Badge;
use Illuminate\Routing\Route;

final class RatingBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $namespace, string $package): array
    {
        $response = $this->client->get($namespace, $package);

        return [
            'label'       => 'rating',
            'status'      => $response['averageRating'].'/5',
            'statusColor' => 'green.600',
        ];
    }

    public function service(): string
    {
        return 'Open VSX';
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
            '/open-vsx/rating/{namespace}/{package}',
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
            '/open-vsx/rating/idleberg/electron-builder'  => 'rating',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
