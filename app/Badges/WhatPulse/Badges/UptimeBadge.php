<?php

declare(strict_types=1);

namespace App\Badges\WhatPulse\Badges;

use App\Badges\Templates\TextTemplate;
use App\Badges\WhatPulse\Client;
use App\Contracts\Badge;
use Illuminate\Routing\Route;
use Illuminate\Support\Arr;

final class UptimeBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $userType, string $id): array
    {
        return TextTemplate::make('uptime', Arr::get($this->client->get($userType, $id), $userType === 'team' ? 'Team.UptimeLong' : 'UptimeLong'), 'green.600');
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
        return [
            //
        ];
    }

    public function routePaths(): array
    {
        return [
            '/whatpulse/uptime/{userType}/{id}',
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
        $route->whereIn('userType', ['user', 'team']);
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
            '/whatpulse/uptime/user/179734' => 'license',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
