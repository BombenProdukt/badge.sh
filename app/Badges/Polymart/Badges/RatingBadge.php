<?php

declare(strict_types=1);

namespace App\Badges\Polymart\Badges;

use App\Enums\Category;

final class RatingBadge extends AbstractBadge
{
    protected array $routes = [
        '/polymart/rating/{resourceId}',
    ];

    protected array $keywords = [
        Category::SOCIAL,
    ];

    public function handle(string $resourceId): array
    {
        return $this->client->get($resourceId)['reviews'];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('rating', $properties['count']);
    }

    public function previews(): array
    {
        return [
            '/polymart/rating/323' => 'rating',
        ];
    }
}
