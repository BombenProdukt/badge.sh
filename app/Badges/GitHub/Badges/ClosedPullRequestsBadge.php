<?php

declare(strict_types=1);

namespace App\Badges\GitHub\Badges;

use App\Enums\Category;

final class ClosedPullRequestsBadge extends AbstractBadge
{
    protected array $routes = [
        '/github/closed-pull-requests/{owner}/{repo}',
    ];

    protected array $keywords = [
        Category::ISSUE_TRACKING,
    ];

    public function handle(string $owner, string $repo): array
    {
        $result = $this->client->makeRepoQuery($owner, $repo, 'pullRequests(states:[CLOSED, MERGED]) { totalCount }');

        return [
            'count' => $result['pullRequests']['totalCount'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('closed PRs', $properties['count']);
    }

    public function previews(): array
    {
        return [
            '/github/closed-pull-requests/micromatch/micromatch' => 'closed PRs',
        ];
    }
}
