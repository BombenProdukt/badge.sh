<?php

declare(strict_types=1);

namespace App\Badges\GitLab\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class ClosedIssuesBadge extends AbstractBadge
{
    protected array $routes = [
        '/gitlab/closed-issues/{repo:wildcard}',
    ];

    protected array $keywords = [
        Category::ISSUE_TRACKING,
    ];

    public function handle(string $repo): array
    {
        return $this->client->graphql($repo, 'issues(state:closed){ count }')['issues'];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('closed issues', $properties['count']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'issues',
                path: '/gitlab/closed-issues/gitlab-org/gitlab-runner',
                data: $this->render(['count' => '42']),
            ),
        ];
    }
}
