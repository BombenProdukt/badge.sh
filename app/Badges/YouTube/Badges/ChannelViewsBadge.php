<?php

declare(strict_types=1);

namespace App\Badges\YouTube\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class ChannelViewsBadge extends AbstractBadge
{
    public function handle(string $channelId): array
    {
        return $this->renderNumber('views', $this->client->channel($channelId)['viewCount']);
    }

    public function keywords(): array
    {
        return [Category::SOCIAL];
    }

    public function routePaths(): array
    {
        return [
            '/youtube/channel/views/{channelId}',
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
            '/youtube/channel/views/UC8butISFwT-Wl7EV0hUK0BQ' => 'channel views',
        ];
    }
}
