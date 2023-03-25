<?php

declare(strict_types=1);

namespace App\Badges\Spiget\Badges;

use App\Enums\Category;

final class RatingBadge extends AbstractBadge
{
    protected array $routes = [
        '/spiget/rating/{resourceId}',
    ];

    protected array $keywords = [
        Category::RATING,
    ];

    public function handle(string $resourceId): array
    {
        return $this->client->resource($resourceId);
    }

    public function render(array $properties): array
    {
        return $this->renderRating($properties['rating']);
    }

    public function previews(): array
    {
        return [
            '/spiget/rating/9089' => 'rating',
        ];
    }
}
