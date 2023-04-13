<?php

declare(strict_types=1);

namespace App\Badges\Pub;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class LikesBadge extends AbstractBadge
{
    protected string $route = '/pub/likes/{package}';

    protected array $keywords = [
        Category::SOCIAL,
    ];

    public function handle(string $package): array
    {
        return [
            'count' => $this->client->api("packages/{$package}/score")['likeCount'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('popularity', $properties['count']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'likes',
                path: '/pub/likes/firebase_core',
                data: $this->render(['count' => 1]),
            ),
        ];
    }
}
