<?php

declare(strict_types=1);

namespace App\Badges\VaadinAddOnDirectory\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class RatingCountBadge extends AbstractBadge
{
    public function handle(string $packageName): array
    {
        return $this->renderNumber('rating count', $this->client->get($packageName)['ratingCount']);
    }

    public function keywords(): array
    {
        return [Category::RATING];
    }

    public function routePaths(): array
    {
        return [
            '/vaadin/rating-count/{packageName}',
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
            '/vaadin/rating-count/vaadinvaadin-grid' => 'rating count',
        ];
    }
}
