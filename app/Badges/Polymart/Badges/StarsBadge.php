<?php

declare(strict_types=1);

namespace App\Badges\Polymart\Badges;

use App\Enums\Category;

final class StarsBadge extends AbstractBadge
{
    protected array $routes = [
        '/polymart/stars/{resourceId}',
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
        return $this->renderStars('rating', $properties['stars']);
    }

    public function previews(): array
    {
        return [
            '/polymart/stars/323' => 'stars',
        ];
    }
}
