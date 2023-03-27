<?php

declare(strict_types=1);

namespace App\Badges\YouTube\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class ChannelViewsBadge extends AbstractBadge
{
    protected string $route = '/youtube/channel/views/{channelId}';

    protected array $keywords = [
        Category::SOCIAL,
    ];

    public function handle(string $channelId): array
    {
        return [
            'views' => $this->client->channel($channelId)['viewCount'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('views', $properties['views']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'channel views',
                path: '/youtube/channel/views/UC8butISFwT-Wl7EV0hUK0BQ',
                data: $this->render(['views' => '1000000']),
            ),
        ];
    }
}
