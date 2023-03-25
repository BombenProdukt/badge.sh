<?php

declare(strict_types=1);

namespace App\Badges\CircleCI\Badges;

use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class StatusBadge extends AbstractBadge
{
    /**
     * The routes to access this badge.
     *
     * @var array<int, string>
     */
    protected array $routes = [
        '/circleci/status/{vcs}/{repo}/{branch?}',
    ];

    /**
     * The keywords that describe this badge.
     *
     * @var array<int, string>
     */
    protected array $keywords = [
        Category::ANALYSIS,
    ];

    public function handle(string $vcs, string $repo, ?string $branch = null): array
    {
        return $this->client->get($vcs, $repo, $branch)[0];
    }

    public function render(array $properties): array
    {
        return [
            'label' => 'circleci',
            'message' => \str_replace('_', ' ', $properties['status']),
            'messageColor' => ['failed' => 'red.600', 'success' => 'green.600'][$properties['status']] ?? 'gray.600',
        ];
    }

    public function routeParameters(): array
    {
        return [];
    }

    public function routeConstraints(Route $route): void
    {
        $route->whereIn('vcs', ['github', 'gitlab']);
        $route->where('repo', RoutePattern::PACKAGE_WITH_VENDOR_ONLY->value);
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/circleci/status/github/circleci/ex' => 'build',
            '/circleci/status/github/circleci/ex/main' => 'build (branch)',
        ];
    }
}
