<?php

declare(strict_types=1);

namespace App\Badges\JetBrains\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class StarsBadge extends AbstractBadge
{
    /**
     * The routes to access this badge.
     *
     * @var array<int, string>
     */
    protected array $routes = [
        '/jetbrains/stars/{pluginId}',
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
        return $this->renderStars('rating', $properties['rating']);
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
            '/jetbrains/stars/13441-laravel-idea' => 'stars',
            '/jetbrains/stars/9630' => 'stars (legacy plugin)',
        ];
    }
}
