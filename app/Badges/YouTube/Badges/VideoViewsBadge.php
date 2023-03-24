<?php

declare(strict_types=1);

namespace App\Badges\YouTube\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class VideoViewsBadge extends AbstractBadge
{
    public function handle(string $videoId): array
    {
        return $this->renderNumber('views', $this->client->video($videoId)['viewCount']);
    }

    public function keywords(): array
    {
        return [Category::SOCIAL];
    }

    public function routePaths(): array
    {
        return [
            '/youtube/video/views/{videoId}',
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
            '/youtube/video/views/wGJHwc5ksMA' => 'video views',
        ];
    }
}
