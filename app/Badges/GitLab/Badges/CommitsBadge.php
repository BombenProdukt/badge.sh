<?php

declare(strict_types=1);

namespace App\Badges\GitLab\Badges;

use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class CommitsBadge extends AbstractBadge
{
    /**
     * The routes to access this badge.
     *
     * @var array<int, string>
     */
    protected array $routes = [
        '/gitlab/commits/{repo}/{ref?}',
    ];

    /**
     * The keywords that describe this badge.
     *
     * @var array<int, string>
     */
    protected array $keywords = [
        Category::SOCIAL,
    ];

    public function handle(string $repo, ?string $ref = null): array
    {
        return [
            'count' => $this->client->rest($repo, $ref ? "repository/commits?ref={$ref}" : 'repository/commits')->header('x-total'),
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('commits', $properties['count']);
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
            '/gitlab/commits/cryptsetup/cryptsetup' => 'commits count',
            '/gitlab/commits/cryptsetup/cryptsetup/coverity_scan' => 'commits count (branch ref)',
            '/gitlab/commits/cryptsetup/cryptsetup/v2.2.2' => 'commits count (tag ref)',
        ];
    }
}
