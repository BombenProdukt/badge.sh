<?php

declare(strict_types=1);

namespace App\Badges\Sourcegraph\Badges;

use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class DependentsBadge extends AbstractBadge
{
    protected array $routes = [
        '/sourcegraph/dependents/{repo}',
    ];

    protected array $keywords = [
        Category::SOCIAL,
    ];

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
