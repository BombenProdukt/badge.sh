<?php

declare(strict_types=1);

namespace App\Badges\WhatPulse\Badges;

use App\Badges\AbstractBadge;
use App\Badges\WhatPulse\Client;
use Illuminate\Routing\Route;
use Illuminate\Support\Arr;

final class KeysBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $userType, string $id): array
    {
        return $this->renderNumber('keys', Arr::get($this->client->get($userType, $id), $userType === 'team' ? 'Team.Keys' : 'Keys'));
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
            '/whatpulse/keys/{userType}/{id}',
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
            '/whatpulse/keys/user/179734' => 'license',
        ];
    }
}
