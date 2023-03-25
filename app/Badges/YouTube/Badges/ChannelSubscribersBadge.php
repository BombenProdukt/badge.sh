<?php

declare(strict_types=1);

namespace App\Badges\YouTube\Badges;

use App\Enums\Category;

final class ChannelSubscribersBadge extends AbstractBadge
{
    protected array $routes = [
        '/youtube/channel/subscribers/{channelId}',
    ];

    protected array $keywords = [
        Category::SOCIAL,
    ];

    public function handle(string $channelId): array
    {
        return [
            'count' => $this->client->channel($channelId)['subscriberCount'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('subscribers', $properties['count']);
    }

    public function previews(): array
    {
        return [
            '/youtube/channel/subscribers/UC8butISFwT-Wl7EV0hUK0BQ' => 'channel subscribers',
        ];
    }
}
