<?php

declare(strict_types=1);

namespace App\Badges\Bundlephobia\Badges;

use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class DependencyCountBadge extends AbstractBadge
{
    protected array $routes = [
        '/bundlephobia/dependency-count/{name}',
    ];

    protected array $keywords = [
        Category::DEPENDENCIES,
    ];

    public function handle(string $name): array
    {
        return [
            'count' => $this->client->get($name)['dependencyCount'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('dependency count', $properties['count']);
    }

    public function routeConstraints(Route $route): void
    {
        $route->where('name', RoutePattern::CATCH_ALL->value);
    }

    public function previews(): array
    {
        return [
            '/bundlephobia/dependency-count/react' => 'dependency count',
        ];
    }
}
