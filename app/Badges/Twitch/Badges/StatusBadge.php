<?php

declare(strict_types=1);

namespace App\Badges\Twitch\Badges;

use App\Badges\AbstractBadge;
use App\Badges\Twitch\Client;
use App\Enums\Category;
use Illuminate\Routing\Route;

final class StatusBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $username): array
    {
        $isLive = count($this->client->user($username)) > 1;

        return $this->renderText('twitch', $isLive ? 'live' : 'offline', $isLive ? 'green.600' : 'red.600');
    }

    public function service(): string
    {
        return 'Twitch';
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
