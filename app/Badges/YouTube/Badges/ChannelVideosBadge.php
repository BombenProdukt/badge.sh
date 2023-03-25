<?php

declare(strict_types=1);

namespace App\Badges\YouTube\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class ChannelVideosBadge extends AbstractBadge
{
    protected array $routes = [
        '/youtube/channel/videos/{channelId}',
    ];

    protected array $keywords = [
        Category::LICENSE,
    ];

    public function handle(string $channelId): array
    {
        return [
            'count' => $this->client->channel($channelId)['videoCount'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('videos', $properties['count']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'channel videos',
                path: '/youtube/channel/videos/UC8butISFwT-Wl7EV0hUK0BQ',
                data: $this->render(['count' => '1000']),
            ),
        ];
    }
}
