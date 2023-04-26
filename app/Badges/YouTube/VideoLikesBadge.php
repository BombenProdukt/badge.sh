<?php

declare(strict_types=1);

namespace App\Badges\YouTube;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class VideoLikesBadge extends AbstractBadge
{
    protected string $route = '/youtube/video/likes/{videoId}';

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

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'video likes',
                path: '/youtube/video/likes/wGJHwc5ksMA',
                data: $this->render(['likes' => '1000000']),
            ),
        ];
    }
}
