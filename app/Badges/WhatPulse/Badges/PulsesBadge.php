<?php

declare(strict_types=1);

namespace App\Badges\WhatPulse\Badges;

use App\Badges\AbstractBadge;
use App\Badges\Templates\NumberTemplate;
use App\Badges\WhatPulse\Client;
use Illuminate\Routing\Route;
use Illuminate\Support\Arr;

final class PulsesBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $userType, string $id): array
    {
        return NumberTemplate::make('pulses', Arr::get($this->client->get($userType, $id), $userType === 'team' ? 'Team.Pulses' : 'Pulses'));
    }

    public function service(): string
    {
        return 'WhatPulse';
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
            '/whatpulse/pulses/{userType}/{id}',
        ];
    }

    public function routeParameters(): array
    {
        return [];
    }

    public function routeConstraints(Route $route): void
    {
        $route->whereIn('userType', ['user', 'team']);
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/whatpulse/pulses/user/179734' => 'license',
        ];
    }
}
