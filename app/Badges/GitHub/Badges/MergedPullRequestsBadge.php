<?php

declare(strict_types=1);

namespace App\Badges\GitHub\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class MergedPullRequestsBadge extends AbstractBadge
{
    protected array $routes = [
        '/github/merged-pull-requests/{owner}/{repo}',
    ];

    protected array $keywords = [
        Category::ISSUE_TRACKING,
    ];

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

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'merged PRs',
                path: '/github/merged-pull-requests/micromatch/micromatch',
                data: $this->render(['count' => '1000']),
            ),
        ];
    }
}
