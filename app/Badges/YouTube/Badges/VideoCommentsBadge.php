<?php

declare(strict_types=1);

namespace App\Badges\YouTube\Badges;

use App\Enums\Category;

final class VideoCommentsBadge extends AbstractBadge
{
    protected array $routes = [
        '/youtube/video/comments/{videoId}',
    ];

    protected array $keywords = [
        Category::SOCIAL,
    ];

    public function handle(string $videoId): array
    {
        return [
            'comments' => $this->client->video($videoId)['commentCount'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('comments', $properties['comments']);
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/youtube/video/comments/wGJHwc5ksMA' => 'video comments',
        ];
    }
}
