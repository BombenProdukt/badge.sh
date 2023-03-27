<?php

declare(strict_types=1);

namespace App\Badges\Discourse\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class LikesBadge extends AbstractBadge
{
    protected string $route = '/discourse/likes/{server}';

    protected array $keywords = [
        Category::METRICS,
    ];

    public function handle(string $server): array
    {
        return [
            'count' => $this->client->statistics($server)['like_count'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('likes', $properties['count']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'likes',
                path: '/discourse/likes/meta.discourse.org',
                data: $this->render(['count' => '1000']),
            ),
        ];
    }
}
