<?php

declare(strict_types=1);

namespace App\Badges\WhatPulse\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;
use Illuminate\Routing\Route;
use Illuminate\Support\Arr;

final class UptimeBadge extends AbstractBadge
{
    protected array $routes = [
        '/whatpulse/uptime/{userType}/{id}',
    ];

    protected array $keywords = [
        Category::ANALYSIS,
    ];

    public function handle(string $userType, string $id): array
    {
        return [
            'time' => Arr::get($this->client->get($userType, $id), $userType === 'team' ? 'Team.UptimeLong' : 'UptimeLong'),
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderText('uptime', $properties['time'], 'green.600');
    }

    public function routeConstraints(Route $route): void
    {
        $route->whereIn('userType', ['user', 'team']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'license',
                path: '/whatpulse/uptime/user/179734',
                data: $this->render([]),
            ),
        ];
    }
}
