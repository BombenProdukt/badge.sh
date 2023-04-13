<?php

declare(strict_types=1);

namespace App\Badges\GitHub;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class ClosedIssuesBadge extends AbstractBadge
{
    protected string $route = '/github/closed-issues/{owner}/{repo}';

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
            new BadgePreviewData(
                name: 'closed issues',
                path: '/github/closed-issues/micromatch/micromatch',
                data: $this->render(['count' => '1000']),
            ),
        ];
    }
}
