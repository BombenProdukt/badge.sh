<?php

declare(strict_types=1);

namespace App\Badges\JetBrains\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class RatingBadge extends AbstractBadge
{
    /**
     * The routes to access this badge.
     *
     * @var array<int, string>
     */
    protected array $routes = [
        '/jetbrains/rating/{pluginId}',
    ];

    /**
     * The keywords that describe this badge.
     *
     * @var array<int, string>
     */
    protected array $keywords = [
        Category::RATING,
    ];

    public function handle(string $pluginId): array
    {
        if (\is_numeric($pluginId)) {
            return [
                'rating' => $this->client->legacy($pluginId)->filterXPath('//plugin-repository//category//idea-plugin//rating')->text(),
            ];
        }

        return [
            'rating' => $this->client->rating($pluginId)['meanRating'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderRating($properties['rating']);
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
            '/jetbrains/rating/13441-laravel-idea' => 'rating',
            '/jetbrains/rating/9630' => 'rating (legacy plugin)',
        ];
    }
}
