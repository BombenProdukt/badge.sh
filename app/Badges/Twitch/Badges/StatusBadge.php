<?php

declare(strict_types=1);

namespace App\Badges\Twitch\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class StatusBadge extends AbstractBadge
{
    public function handle(string $username): array
    {
        return [
            'status' => count($this->client->user($username)) > 1 ? 'online' : 'offline',
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderText(
            'twitch',
            $properties['status'] === 'online' ? 'live' : 'offline',
            $properties['status'] === 'online' ? 'green.600' : 'red.600',
        );
    }

    public function keywords(): array
    {
        return [Category::SOCIAL];
    }

    public function routePaths(): array
    {
        return [
            '/twitch/status/{username}',
        ];
    }

    public function routeParameters(): array
    {
        return [];
    }

    public function routeConstraints(Route $route): void
    {
        //
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/twitch/status/andyonthewings' => 'status',
        ];
    }
}
