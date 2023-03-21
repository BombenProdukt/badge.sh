<?php

declare(strict_types=1);

namespace App\Badges\Ecologi\Badges;

use App\Badges\Ecologi\Client;
use App\Badges\Templates\NumberTemplate;
use App\Contracts\Badge;
use Illuminate\Routing\Route;

final class CarbonBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $username): array
    {
        return NumberTemplate::make('carbon offset', $this->client->carbon($username));
    }

    public function service(): string
    {
        return 'Ecologi';
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
            '/ecologi/carbon/{username}',
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
            '/ecologi/carbon/ecologi' => 'license',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
