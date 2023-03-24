<?php

declare(strict_types=1);

namespace App\Badges\DUB\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class RatingBadge extends AbstractBadge
{
    public function handle(string $package): array
    {
        return $this->client->get("{$package}/stats");
    }

    public function render(array $properties): array
    {
        return [
            'label'        => 'rating',
            'message'      => number_format($properties['score'] / 5, 2),
            'messageColor' => 'green.600',
        ];
    }

    public function keywords(): array
    {
        return [Category::RATING];
    }

    public function routePaths(): array
    {
        return [
            '/dub/rating/{package}',
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
            '/dub/rating/pegged' => 'rating',
        ];
    }
}
