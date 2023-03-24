<?php

declare(strict_types=1);

namespace App\Badges\Sourcegraph\Badges;

use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class DependentsBadge extends AbstractBadge
{
    public function handle(string $repo): array
    {
        return [
            'count' => $this->client->dependents($repo),
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('used by', $properties['count']);
    }

    public function keywords(): array
    {
        return [Category::SOCIAL];
    }

    public function routePaths(): array
    {
        return [
            '/sourcegraph/dependents/{repo}',
        ];
    }

    public function routeParameters(): array
    {
        return [];
    }

    public function routeConstraints(Route $route): void
    {
        $route->where('repo', RoutePattern::CATCH_ALL->value);
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/sourcegraph/dependents/github.com/gorilla/mux' => 'dependents',
        ];
    }
}
