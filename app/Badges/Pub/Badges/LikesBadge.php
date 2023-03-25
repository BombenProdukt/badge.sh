<?php

declare(strict_types=1);

namespace App\Badges\Pub\Badges;

use App\Enums\Category;

final class LikesBadge extends AbstractBadge
{
    protected array $routes = [
        '/pub/likes/{package}',
    ];

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

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/pub/likes/firebase_core' => 'likes',
        ];
    }
}
