<?php

declare(strict_types=1);

namespace App\Badges\WordPress\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;
use Illuminate\Routing\Route;

final class RatingsBadge extends AbstractBadge
{
    protected array $routes = [
        '/wordpress/{extensionType}/ratings/{extension}',
    ];

    protected array $keywords = [
        Category::RATING,
    ];

    public function handle(string $extensionType, string $extension): array
    {
        return [
            'rating' => $this->client->info($extensionType, $extension)['num_ratings'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('ratings', $properties['rating']);
    }

    public function routeConstraints(Route $route): void
    {
        $route->whereIn('extensionType', ['plugin', 'theme']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'ratings (plugin)',
                path: '/wordpress/plugin/ratings/bbpress',
                data: $this->render(['rating' => '4.5']),
            ),
            new BadgePreviewData(
                name: 'ratings (theme)',
                path: '/wordpress/theme/ratings/twentyseventeen',
                data: $this->render(['rating' => '4.5']),
            ),
        ];
    }
}
