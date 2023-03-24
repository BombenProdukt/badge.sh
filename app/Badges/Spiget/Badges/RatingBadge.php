<?php

declare(strict_types=1);

namespace App\Badges\Spiget\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class RatingBadge extends AbstractBadge
{
    public function handle(string $resourceId): array
    {
        return $this->client->resource($resourceId);
    }

    public function render(array $properties): array
    {
        return $this->renderRating($properties['rating']);
    }

    public function keywords(): array
    {
        return [Category::RATING];
    }

    public function routePaths(): array
    {
        return [
            '/spiget/rating/{resourceId}',
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
            '/spiget/rating/9089' => 'rating',
        ];
    }
}
