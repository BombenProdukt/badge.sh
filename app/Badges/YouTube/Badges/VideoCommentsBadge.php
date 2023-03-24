<?php

declare(strict_types=1);

namespace App\Badges\YouTube\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class VideoCommentsBadge extends AbstractBadge
{
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

    public function keywords(): array
    {
        return [Category::SOCIAL];
    }

    public function routePaths(): array
    {
        return [
            '/youtube/video/comments/{videoId}',
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
            '/youtube/video/comments/wGJHwc5ksMA' => 'video comments',
        ];
    }
}
