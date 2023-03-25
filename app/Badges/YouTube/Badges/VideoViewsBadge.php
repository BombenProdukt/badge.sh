<?php

declare(strict_types=1);

namespace App\Badges\YouTube\Badges;

use App\Enums\Category;

final class VideoViewsBadge extends AbstractBadge
{
    protected array $routes = [
        '/youtube/video/views/{videoId}',
    ];

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

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/youtube/video/views/wGJHwc5ksMA' => 'video views',
        ];
    }
}
