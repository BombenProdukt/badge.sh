<?php

declare(strict_types=1);

namespace App\Badges\YouTube\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class VideoLikesBadge extends AbstractBadge
{
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

    public function keywords(): array
    {
        return [Category::SOCIAL];
    }

    public function routePaths(): array
    {
        return [
            '/youtube/video/likes/{videoId}',
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
