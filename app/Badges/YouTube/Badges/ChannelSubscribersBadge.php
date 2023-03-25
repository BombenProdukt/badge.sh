<?php

declare(strict_types=1);

namespace App\Badges\YouTube\Badges;

use App\Data\BadgePreviewData;
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
            new BadgePreviewData(
                name: 'channel subscribers',
                path: '/youtube/channel/subscribers/UC8butISFwT-Wl7EV0hUK0BQ',
                data: $this->render(['count' => '1000']),
            ),
        ];
    }
}
