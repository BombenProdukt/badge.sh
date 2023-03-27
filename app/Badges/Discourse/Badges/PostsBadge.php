<?php

declare(strict_types=1);

namespace App\Badges\Discourse\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class PostsBadge extends AbstractBadge
{
    protected string $route = '/discourse/posts/{server}';

    protected array $keywords = [
        Category::METRICS,
    ];

    public function handle(string $server): array
    {
        return [
            'count' => $this->client->statistics($server)['post_count'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('posts', $properties['count']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'posts',
                path: '/discourse/posts/meta.discourse.org',
                data: $this->render(['count' => 0]),
            ),
        ];
    }
}
