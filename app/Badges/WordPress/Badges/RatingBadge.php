<?php

declare(strict_types=1);

namespace App\Badges\WordPress\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class RatingBadge extends AbstractBadge
{
    protected array $routes = [
        '/wordpress/{extensionType}/rating/{extension}',
    ];

    protected array $keywords = [
        Category::RATING,
    ];

    public function handle(string $extensionType, string $extension): array
    {
        return $this->client->info($extensionType, $extension);
    }

    public function render(array $properties): array
    {
        return $this->renderRating($properties['rating']);
    }

    public function routeConstraints(Route $route): void
    {
        $route->whereIn('extensionType', ['plugin', 'theme']);
    }

    public function previews(): array
    {
        return [
            '/wordpress/plugin/rating/bbpress' => 'rating (plugin)',
            '/wordpress/theme/rating/twentyseventeen' => 'rating (theme)',
        ];
    }
}
