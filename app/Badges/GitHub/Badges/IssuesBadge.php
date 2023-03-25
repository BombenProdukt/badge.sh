<?php

declare(strict_types=1);

namespace App\Badges\GitHub\Badges;

use App\Enums\Category;

final class IssuesBadge extends AbstractBadge
{
    protected array $routes = [
        '/github/issues/{owner}/{repo}',
    ];

    protected array $keywords = [
        Category::ISSUE_TRACKING,
    ];

    public function handle(string $owner, string $repo): array
    {
        return [
            'count' => $this->client->makeRepoQuery($owner, $repo, 'issues { totalCount }')['issues']['totalCount'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('issues', $properties['count']);
    }

    public function previews(): array
    {
        return [
            '/github/issues/micromatch/micromatch' => 'issues',
        ];
    }
}
