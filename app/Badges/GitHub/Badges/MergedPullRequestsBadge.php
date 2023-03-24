<?php

declare(strict_types=1);

namespace App\Badges\GitHub\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class MergedPullRequestsBadge extends AbstractBadge
{
    public function handle(string $owner, string $repo)
    {
        return [
            'count' => $this->client->makeRepoQuery($owner, $repo, 'pullRequests(states:[MERGED]) { totalCount }')['pullRequests']['totalCount'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('merged PRs', $properties['count']);
    }

    public function keywords(): array
    {
        return [Category::ISSUE_TRACKING];
    }

    public function routePaths(): array
    {
        return [
            '/github/merged-pull-requests/{owner}/{repo}',
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
            '/github/merged-pull-requests/micromatch/micromatch' => 'merged PRs',

        ];
    }
}
