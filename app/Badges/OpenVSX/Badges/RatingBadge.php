<?php

declare(strict_types=1);

namespace App\Badges\OpenVSX\Badges;

use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class RatingBadge extends AbstractBadge
{
    public function handle(string $extension): array
    {
        $response = $this->client->get($extension);

        return [
            'rating' => $response['averageRating'],
        ];
    }

    public function render(array $properties): array
    {
        return [
            'label' => 'rating',
            'message' => $properties['rating'].'/5',
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
            '/open-vsx/rating/{extension}',
        ];
    }

    public function routeParameters(): array
    {
        return [];
    }

    public function routeConstraints(Route $route): void
    {
        $route->where('extension', RoutePattern::CATCH_ALL->value);
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/open-vsx/rating/idleberg/electron-builder' => 'rating',
        ];
    }
}
