<?php

declare(strict_types=1);

namespace App\Badges\WhatPulse\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;
use Illuminate\Support\Arr;

final class UptimeBadge extends AbstractBadge
{
    public function handle(string $userType, string $id): array
    {
        return $this->renderText('uptime', Arr::get($this->client->get($userType, $id), $userType === 'team' ? 'Team.UptimeLong' : 'UptimeLong'), 'green.600');
    }

    public function keywords(): array
    {
        return [Category::ANALYSIS];
    }

    public function routePaths(): array
    {
        return [
            '/whatpulse/uptime/{userType}/{id}',
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
            '/whatpulse/uptime/user/179734' => 'license',
        ];
    }
}
