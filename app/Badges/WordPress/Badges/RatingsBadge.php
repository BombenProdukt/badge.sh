<?php

declare(strict_types=1);

namespace App\Badges\WordPress\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class RatingsBadge extends AbstractBadge
{
    public function handle(string $extensionType, string $extension): array
    {
        return [
            'count' => $this->client->info($extensionType, $extension)['num_ratings'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('ratings', $properties['count']);
    }

    public function keywords(): array
    {
        return [Category::RATING];
    }

    public function routePaths(): array
    {
        return [
            '/wordpress/{extensionType}/ratings/{extension}',
        ];
    }

    public function routeConstraints(Route $route): void
    {
        $route->whereIn('extensionType', ['plugin', 'theme']);
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/wordpress/plugin/ratings/bbpress'        => 'ratings (plugin)',
            '/wordpress/theme/ratings/twentyseventeen' => 'ratings (theme)',
        ];
    }
}
