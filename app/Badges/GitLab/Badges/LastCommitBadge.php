<?php

declare(strict_types=1);

namespace App\Badges\GitLab\Badges;

use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class LastCommitBadge extends AbstractBadge
{
    /**
     * The routes to access this badge.
     *
     * @var array<int, string>
     */
    protected array $routes = [
        '/gitlab/last-commit/{repo}/{ref?}',
    ];

    /**
     * The keywords that describe this badge.
     *
     * @var array<int, string>
     */
    protected array $keywords = [
        Category::ACTIVITY,
    ];

    public function handle(string $repo, ?string $ref = null): array
    {
        return [
            'date' => $this->client->rest($repo, $ref ? "repository/commits?ref={$ref}" : 'repository/commits')->json('0.committed_date'),
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderDateDiff('last commit', $properties['date']);
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
            '/gitlab/last-commit/gitlab-org/gitlab-development-kit' => 'last commit',
            '/gitlab/last-commit/gitlab-org/gitlab-development-kit/updating-chromedriver-install-v2' => 'last commit (branch ref)',
            '/gitlab/last-commit/gitlab-org/gitlab-development-kit/v0.2.5' => 'last commit (tag ref)',
        ];
    }
}
