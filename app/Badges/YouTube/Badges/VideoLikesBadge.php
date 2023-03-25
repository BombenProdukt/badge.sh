<?php

declare(strict_types=1);

namespace App\Badges\YouTube\Badges;

use App\Enums\Category;

final class VideoLikesBadge extends AbstractBadge
{
    protected array $routes = [
        '/youtube/video/likes/{videoId}',
    ];

    protected array $keywords = [
        Category::SOCIAL,
    ];

    public function handle(string $videoId): array
    {
        return [
            'likes' => $this->client->video($videoId)['likeCount'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('likes', $properties['likes']);
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/youtube/video/likes/wGJHwc5ksMA' => 'video likes',
        ];
    }
}
