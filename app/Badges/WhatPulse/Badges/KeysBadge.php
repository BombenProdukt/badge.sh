<?php

declare(strict_types=1);

namespace App\Badges\WhatPulse\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;
use Illuminate\Routing\Route;
use Illuminate\Support\Arr;

final class KeysBadge extends AbstractBadge
{
    protected array $routes = [
        '/whatpulse/keys/{userType}/{id}',
    ];

    protected array $keywords = [
        Category::ACTIVITY,
    ];

    public function handle(string $userType, string $id): array
    {
        return [
            'count' => Arr::get($this->client->get($userType, $id), $userType === 'team' ? 'Team.Keys' : 'Keys'),
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('keys', $properties['count']);
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
                path: '/whatpulse/keys/user/179734',
                data: $this->render(['count' => 1]),
            ),
        ];
    }
}
