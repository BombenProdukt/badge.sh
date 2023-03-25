<?php

declare(strict_types=1);

namespace App\Badges\Codecov\Badges;

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
        '/codecov/coverage/{service}/{repo}/{branch?}',
    ];

    /**
     * The keywords that describe this badge.
     *
     * @var array<int, string>
     */
    protected array $keywords = [
        Category::ANALYSIS, Category::COVERAGE,
    ];

    public function handle(string $service, string $repo, ?string $branch = null): array
    {
        return [
            'percentage' => $this->client->get($service, $repo, $branch)['commit']['totals']['c'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderCoverage($properties['percentage']);
    }

    public function routeParameters(): array
    {
        return [];
    }

    public function routeConstraints(Route $route): void
    {
        $route->whereIn('service', ['github', 'bitbucket', 'gitlab']);
        $route->where('repo', RoutePattern::CATCH_ALL->value);
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/codecov/coverage/github/babel/babel' => 'coverage (github)',
            '/codecov/coverage/github/babel/babel/6.x' => 'coverage (github, branch)',
            '/codecov/coverage/bitbucket/ignitionrobotics/ign-math' => 'coverage (bitbucket)',
            '/codecov/coverage/bitbucket/ignitionrobotics/ign-math/master' => 'coverage (bitbucket, branch)',
            '/codecov/coverage/gitlab/gitlab-org/gitaly' => 'coverage (gitlab)',
            '/codecov/coverage/gitlab/gitlab-org/gitaly/master' => 'coverage (gitlab, branch)',
        ];
    }
}
