<?php

declare(strict_types=1);

namespace App\Badges\YouTube\Badges;

use App\Enums\Category;

final class ChannelViewsBadge extends AbstractBadge
{
    protected array $routes = [
        '/youtube/channel/views/{channelId}',
    ];

    protected array $keywords = [
        Category::SOCIAL,
    ];

    public function handle(string $channelId): array
    {
        return [
            'count' => $this->client->channel($channelId)['viewCount'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('views', $properties['count']);
    }

    public function previews(): array
    {
        return [
            '/youtube/channel/views/UC8butISFwT-Wl7EV0hUK0BQ' => 'channel views',
        ];
    }
}
