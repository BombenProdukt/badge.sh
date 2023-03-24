<?php

declare(strict_types=1);

namespace App\Badges\MozillaAddOns\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class RatingBadge extends AbstractBadge
{
    public function handle(string $package): array
    {
        return $this->client->get($package)['ratings'];
    }

    public function render(array $properties): array
    {
        return $this->renderRating($properties['count']);
    }

    public function keywords(): array
    {
        return [Category::RATING];
    }

    public function routePaths(): array
    {
        return [
            '/amo/rating/{package}',
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
            '/amo/rating/markdown-viewer-chrome' => 'rating',
        ];
    }
}
