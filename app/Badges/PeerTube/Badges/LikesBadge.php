<?php

declare(strict_types=1);

namespace App\Badges\PeerTube\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;
use PreemStudio\Formatter\FormatNumber;

final class LikesBadge extends AbstractBadge
{
    protected string $route = '/peertube/likes/{instance}/{video}';

    protected array $keywords = [
        Category::SOCIAL,
    ];

    public function handle(string $instance, string $video): array
    {
        return [
            'count' => $this->client->get($instance, "videos/{$video}")['likes'],
        ];
    }

    public function render(array $properties): array
    {
        return [
            'label' => 'likes',
            'message' => FormatNumber::execute((float) $properties['count']),
            'messageColor' => 'F1680D',
        ];
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'likes',
                path: '/peertube/likes/framatube.org/9c9de5e8-0a1e-484a-b099-e80766180a6d',
                data: $this->render(['count' => '1000']),
            ),
        ];
    }
}
