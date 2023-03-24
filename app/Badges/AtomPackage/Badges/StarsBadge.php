<?php

declare(strict_types=1);

namespace App\Badges\AtomPackage\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class StarsBadge extends AbstractBadge
{
    public function handle(string $package): array
    {
        return [
            'stars' => $this->client->get($package)['stargazers_count'],
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
            '/apm/stars/{package}',
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
            '/apm/stars/linter' => 'stars',
        ];
    }

    public function deprecated(): array
    {
        return [
            '2023-03-18' => 'Deprecated due to the deprecation of required APIs.',
        ];
    }
}
