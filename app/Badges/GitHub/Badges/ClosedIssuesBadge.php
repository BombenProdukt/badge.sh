<?php

declare(strict_types=1);

namespace App\Badges\GitHub\Badges;

use App\Enums\Category;

final class ClosedIssuesBadge extends AbstractBadge
{
    protected array $routes = [
        '/github/closed-issues/{owner}/{repo}',
    ];

    protected array $keywords = [
        Category::ISSUE_TRACKING,
    ];

    public function handle(string $owner, string $repo): array
    {
        return [
            'count' => $this->client->makeRepoQuery($owner, $repo, 'issues(states:[CLOSED]) { totalCount }'),
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('closed issues', $properties['count']);
    }

    public function previews(): array
    {
        return [
            '/github/closed-issues/micromatch/micromatch' => 'closed issues',
        ];
    }
}
