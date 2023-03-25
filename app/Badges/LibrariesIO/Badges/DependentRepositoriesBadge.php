<?php

declare(strict_types=1);

namespace App\Badges\LibrariesIO\Badges;

use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class DependentRepositoriesBadge extends AbstractBadge
{
    protected array $routes = [
        '/libraries-io/dependent-repositories/{platform}/{package}',
    ];

    protected array $keywords = [
        Category::DEPENDENCIES,
    ];

    public function handle(string $platform, string $package): array
    {
        return [
            'count' => $this->client->get($platform, $package)['dependent_repos_count'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('dependent repositories', $properties['count']);
    }

    public function routeConstraints(Route $route): void
    {
        $route->where('package', RoutePattern::CATCH_ALL->value);
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/libraries-io/dependent-repositories/npm/got' => 'dependent repositories',
            '/libraries-io/dependent-repositories/npm/@babel/core' => 'dependent repositories (scoped)',
        ];
    }
}
