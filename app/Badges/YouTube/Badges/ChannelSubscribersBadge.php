<?php

declare(strict_types=1);

namespace App\Badges\YouTube\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class ChannelSubscribersBadge extends AbstractBadge
{
    public function handle(string $channelId): array
    {
        return $this->renderNumber('subscribers', $this->client->channel($channelId)['subscriberCount']);
    }

    public function keywords(): array
    {
        return [Category::SOCIAL];
    }

    public function routePaths(): array
    {
        return [
            '/youtube/channel/subscribers/{channelId}',
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

    public function staticPresubscribers(): array
    {
        return [];
    }

    public function dynamicPresubscribers(): array
    {
        return [
            '/youtube/channel/subscribers/UC8butISFwT-Wl7EV0hUK0BQ' => 'channel subscribers',
        ];
    }
}
