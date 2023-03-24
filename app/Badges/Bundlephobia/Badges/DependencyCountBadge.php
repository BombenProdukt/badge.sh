<?php

declare(strict_types=1);

namespace App\Badges\Bundlephobia\Badges;

use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class DependencyCountBadge extends AbstractBadge
{
    public function handle(string $name): array
    {
        return [
            'label'        => 'dependency count',
            'message'      => (string) $this->client->get($name)['dependencyCount'],
            'messageColor' => 'blue.600',
        ];
    }

    public function keywords(): array
    {
        return [Category::DEPENDENCIES];
    }

    public function routePaths(): array
    {
        return [
            '/bundlephobia/dependency-count/{name}',
        ];
    }

    public function routeParameters(): array
    {
        return [];
    }

    public function routeConstraints(Route $route): void
    {
        $route->where('name', RoutePattern::CATCH_ALL->value);
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/bundlephobia/dependency-count/react' => 'dependency count',
        ];
    }
}
