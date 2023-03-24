<?php

declare(strict_types=1);

namespace App\Badges\VaadinAddOnDirectory\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class RatingBadge extends AbstractBadge
{
    public function handle(string $packageName): array
    {
        return [
            'rating' => $this->client->get($packageName)['averageRating'],
        ];
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
            '/vaadin/rating/{packageName}',
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
            '/vaadin/rating/vaadinvaadin-grid' => '',
        ];
    }
}
