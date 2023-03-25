<?php

declare(strict_types=1);

namespace App\Badges\GitLab\Badges;

use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;
use PreemStudio\Formatter\FormatNumber;

final class OpenIssuesBadge extends AbstractBadge
{
    public function handle(string $repo): array
    {
        return [
            'count' => $this->client->graphql($repo, 'openIssuesCount')['openIssuesCount'],
        ];
    }

    public function render(array $properties): array
    {
        return [
            'label' => 'open issues',
            'message' => FormatNumber::execute($properties['count']),
            'messageColor' => $properties['count'] === 0 ? 'green.600' : 'orange.600',
        ];
    }

    public function keywords(): array
    {
        return [Category::ISSUE_TRACKING];
    }

    public function routePaths(): array
    {
        return [
            '/gitlab/open-issues/{repo}',
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
            '/gitlab/open-issues/gitlab-org/gitlab-runner' => 'issues',
        ];
    }
}
