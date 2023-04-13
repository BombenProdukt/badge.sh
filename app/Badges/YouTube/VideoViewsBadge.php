<?php

declare(strict_types=1);

namespace App\Badges\YouTube;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class VideoViewsBadge extends AbstractBadge
{
    protected string $route = '/youtube/video/views/{videoId}';

    protected array $keywords = [
        Category::SOCIAL,
    ];

    public function handle(string $videoId): array
    {
        return [
            'views' => $this->client->video($videoId)['viewCount'],
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
                name: 'video views',
                path: '/youtube/video/views/wGJHwc5ksMA',
                data: $this->render(['views' => '1000000']),
            ),
        ];
    }
}
