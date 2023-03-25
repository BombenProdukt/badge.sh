<?php

declare(strict_types=1);

namespace App\Badges\LibrariesIO\Badges;

use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class DependentsBadge extends AbstractBadge
{
    protected array $routes = [
        '/libraries-io/dependents/{platform}/{package}',
    ];

    protected array $keywords = [
        Category::DEPENDENCIES,
    ];

    public function handle(string $platform, string $package): array
    {
        return [
            'count' => $this->client->get($platform, $package)['dependents_count'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('dependents', $properties['count']);
    }

    public function routeConstraints(Route $route): void
    {
        $route->where('package', RoutePattern::CATCH_ALL->value);
    }

    public function previews(): array
    {
        return [
            '/libraries-io/dependents/npm/got' => 'dependents',
            '/libraries-io/dependents/npm/@babel/core' => 'dependents (scoped)',
        ];
    }
}
