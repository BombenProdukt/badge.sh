<?php

declare(strict_types=1);

namespace App\Badges\GitLab\Badges;

use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class TagsBadge extends AbstractBadge
{
    public function handle(string $repo): array
    {
        return [
            'count' => $this->client->rest($repo, 'repository/tags')->header('x-total'),
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('tags', $properties['count']);
    }

    public function keywords(): array
    {
        return [Category::VERSION];
    }

    public function routePaths(): array
    {
        return [
            '/gitlab/tags/{repo}',
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
            '/gitlab/tags/commento/commento' => 'tags',
        ];
    }
}
