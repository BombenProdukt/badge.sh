<?php

declare(strict_types=1);

namespace App\Badges\Docker\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class StarsBadge extends AbstractBadge
{
    public function handle(string $scope, string $name): array
    {
        return [
            'stars' => $this->client->info($scope, $name)['star_count'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderStars('stars', $properties['stars']);
    }

    public function keywords(): array
    {
        return [Category::RATING];
    }

    public function routePaths(): array
    {
        return [
            '/docker/stars/{scope}/{name}',
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
            '/docker/stars/library/ubuntu' => 'stars (library)',
            '/docker/stars/library/mongo'  => 'stars (icon & label)',
        ];
    }
}
