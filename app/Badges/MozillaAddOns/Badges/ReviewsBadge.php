<?php

declare(strict_types=1);

namespace App\Badges\MozillaAddOns\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class ReviewsBadge extends AbstractBadge
{
    public function handle(string $package): array
    {
        return [
            'rating' => $this->client->get($package)['ratings']['average'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderRating($properties['rating']);
    }

    public function keywords(): array
    {
        return [Category::SOCIAL];
    }

    public function routePaths(): array
    {
        return [
            '/amo/reviews/{package}',
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
            '/amo/reviews/markdown-viewer-chrome' => 'reviews',
        ];
    }
}
