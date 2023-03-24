<?php

declare(strict_types=1);

namespace App\Badges\GitHub\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;
use PreemStudio\Formatter\FormatNumber;

final class MergedPullRequestsBadge extends AbstractBadge
{
    public function handle(string $owner, string $repo)
    {
        $result = $this->client->makeRepoQuery($owner, $repo, 'pullRequests(states:[MERGED]) { totalCount }');

        return [
            'label'        => 'merged PRs',
            'message'      => FormatNumber::execute($result['pullRequests']['totalCount']),
            'messageColor' => 'blue.600',
        ];
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
