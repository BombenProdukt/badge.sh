<?php

declare(strict_types=1);

namespace App\Badges\GitHub\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class PullRequestsBadge extends AbstractBadge
{
    protected string $route = '/github/pull-requests/{owner}/{repo}';

    protected array $keywords = [
        Category::ISSUE_TRACKING,
    ];

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

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'PRs',
                path: '/github/pull-requests/micromatch/micromatch',
                data: $this->render(['count' => 0]),
            ),
        ];
    }
}
