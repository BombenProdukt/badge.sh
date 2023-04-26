<?php

declare(strict_types=1);

namespace App\Badges\GitLab;

use App\Data\BadgePreviewData;
use App\Enums\Category;
use BombenProdukt\Formatter\FormatNumber;

final class OpenIssuesBadge extends AbstractBadge
{
    protected string $route = '/gitlab/open-issues/{repo:wildcard}';

    protected array $keywords = [
        Category::ISSUE_TRACKING,
    ];

    public function handle(string $repo): array
    {
        return [
            'count' => $this->client->graphql($repo, 'openIssuesCount')['openIssuesCount'],
        ];
    }

    public function render(array $properties): array
    {
        return [
            'label' => 'open issues',
            'message' => FormatNumber::execute((float) $properties['count']),
            'messageColor' => $properties['count'] === 0 ? 'green.600' : 'orange.600',
        ];
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'issues',
                path: '/gitlab/open-issues/gitlab-org/gitlab-runner',
                data: $this->render(['count' => 0]),
            ),
        ];
    }
}
