<?php

declare(strict_types=1);

namespace App\Badges\YouTube\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class ChannelVideosBadge extends AbstractBadge
{
    public function handle(string $channelId): array
    {
        return $this->renderNumber('videos', $this->client->channel($channelId)['videoCount']);
    }

    public function keywords(): array
    {
        return [Category::LICENSE];
    }

    public function routePaths(): array
    {
        return [
            '/youtube/channel/videos/{channelId}',
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

    public function staticPrevideos(): array
    {
        return [];
    }

    public function dynamicPrevideos(): array
    {
        return [
            '/youtube/channel/videos/UC8butISFwT-Wl7EV0hUK0BQ' => 'channel videos',
        ];
    }
}
