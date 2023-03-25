<?php

declare(strict_types=1);

namespace App\Badges\GitLab\Badges;

use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class StarsBadge extends AbstractBadge
{
    protected array $routes = [
        '/gitlab/stars/{repo}',
    ];

    protected array $keywords = [
        Category::RATING,
    ];

    public function handle(string $repo): array
    {
        return [
            'count' => $this->client->graphql($repo, 'starCount')['starCount'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderStars('stars', $properties['count']);
    }

    public function routeConstraints(Route $route): void
    {
        $route->where('repo', RoutePattern::CATCH_ALL->value);
    }

    public function previews(): array
    {
        return [
            '/gitlab/stars/fdroid/fdroidclient' => 'stars',
        ];
    }
}
