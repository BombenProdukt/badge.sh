<?php

declare(strict_types=1);

namespace App\Badges\WhatPulse\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;
use Illuminate\Routing\Route;
use Illuminate\Support\Arr;

final class ClicksBadge extends AbstractBadge
{
    protected array $routes = [
        '/whatpulse/clicks/{userType}/{id}',
    ];

    protected array $keywords = [
        Category::SOCIAL,
    ];

    public function handle(string $userType, string $id): array
    {
        return [
            'count' => Arr::get($this->client->get($userType, $id), $userType === 'team' ? 'Team.Clicks' : 'Clicks'),
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('clicks', $properties['count']);
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
                path: '/whatpulse/clicks/user/179734',
                data: $this->render([]),
            ),
        ];
    }
}
