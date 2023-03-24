<?php

declare(strict_types=1);

namespace App\Badges\GitHub\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class PullRequestsBadge extends AbstractBadge
{
    public function handle(string $owner, string $repo): array
    {
        return [
            'count' => $this->client->makeRepoQuery($owner, $repo, 'pullRequests { totalCount }')['pullRequests']['totalCount'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('PRs', $properties['count']);
    }

    public function keywords(): array
    {
        return [Category::ISSUE_TRACKING];
    }

    public function routePaths(): array
    {
        return [
            '/github/pull-requests/{owner}/{repo}',
        ];
    }

    public function routeParameters(): array
    {
        return [];
    }

    public function routeConstraints(Route $route): void
    {
        //
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/github/pull-requests/micromatch/micromatch' => 'PRs',
        ];
    }
}
