<?php

declare(strict_types=1);

namespace App\Badges\WordPress\Badges;

use App\Badges\AbstractBadge;
use App\Badges\WordPress\Client;
use App\Enums\Category;
use Illuminate\Routing\Route;

final class RatingBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $extensionType, string $extension): array
    {
        return $this->renderDownloads($this->client->info($extensionType, $extension)['rating']);
    }

    public function service(): string
    {
        return 'WordPress';
    }

    public function keywords(): array
    {
        return [Category::RATING];
    }

    public function routePaths(): array
    {
        return [
            '/wordpress/{extensionType}/rating/{extension}',
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
            '/wordpress/plugin/rating/bbpress'        => 'rating (plugin)',
            '/wordpress/theme/rating/twentyseventeen' => 'rating (theme)',
        ];
    }
}
