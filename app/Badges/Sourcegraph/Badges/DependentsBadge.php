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
        return $this->renderText('used by', $this->client->dependents($repo), 'green.600');
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
