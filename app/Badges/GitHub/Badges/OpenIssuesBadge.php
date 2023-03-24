<?php

declare(strict_types=1);

namespace App\Badges\GitHub\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;
use PreemStudio\Formatter\FormatNumber;

final class OpenIssuesBadge extends AbstractBadge
{
    public function handle(string $owner, string $repo): array
    {
        return [
            'count' => $this->client->makeRepoQuery($owner, $repo, 'issues(states:[OPEN]) { totalCount }')['issues']['totalCount'],
        ];
    }

    public function render(array $properties): array
    {
        return [
            'label'        => 'open issues',
            'message'      => FormatNumber::execute($properties['count']),
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
            '/github/open-issues/{owner}/{repo}',
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
            '/github/open-issues/micromatch/micromatch' => 'open issues',

        ];
    }
}
