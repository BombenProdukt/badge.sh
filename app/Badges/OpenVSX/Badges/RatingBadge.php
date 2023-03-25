<?php

declare(strict_types=1);

namespace App\Badges\OpenVSX\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class RatingBadge extends AbstractBadge
{
    protected array $routes = [
        '/open-vsx/rating/{extension}',
    ];

    protected array $keywords = [
        Category::RATING,
    ];

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

    public function routeConstraints(Route $route): void
    {
        $route->where('extension', RoutePattern::CATCH_ALL->value);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'rating',
                path: '/open-vsx/rating/idleberg/electron-builder',
                data: $this->render([]),
            ),
        ];
    }
}
