<?php

declare(strict_types=1);

namespace App\Badges\GitLab\Badges;

use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class ClosedIssuesBadge extends AbstractBadge
{
    protected array $routes = [
        '/gitlab/closed-issues/{repo}',
    ];

    protected array $keywords = [
        Category::ISSUE_TRACKING,
    ];

    public function handle(string $repo): array
    {
        return $this->client->graphql($repo, 'issues(state:closed){ count }')['issues'];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('closed issues', $properties['count']);
    }

    public function routeConstraints(Route $route): void
    {
        $route->where('repo', RoutePattern::CATCH_ALL->value);
    }

    public function previews(): array
    {
        return [
            '/gitlab/closed-issues/gitlab-org/gitlab-runner' => 'issues',
        ];
    }
}
