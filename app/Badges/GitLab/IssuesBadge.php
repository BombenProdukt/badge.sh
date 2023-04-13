<?php

declare(strict_types=1);

namespace App\Badges\GitLab;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class IssuesBadge extends AbstractBadge
{
    protected string $route = '/gitlab/issues/{repo:wildcard}';

    protected array $keywords = [
        Category::ISSUE_TRACKING,
    ];

    public function handle(string $repo): array
    {
        return $this->client->graphql($repo, 'issues{ count }')['issues'];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('issues', $properties['count']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'issues',
                path: '/gitlab/issues/gitlab-org/gitlab-runner',
                data: $this->render(['count' => '1000']),
            ),
        ];
    }
}
