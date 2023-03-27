<?php

declare(strict_types=1);

namespace App\Badges\GitLab\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class ClosedMergeRequestsBadge extends AbstractBadge
{
    protected string $route = '/gitlab/closed-merge-requests/{repo:wildcard}';

    protected array $keywords = [
        Category::ISSUE_TRACKING,
    ];

    public function handle(string $repo): array
    {
        return [
            'count' => $this->client->rest($repo, 'merge_requests?state=closed')->header('x-total'),
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('closed MRs', $properties['count']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'closed MRs',
                path: '/gitlab/closed-merge-requests/edouardklein/falsisign',
                data: $this->render(['count' => '1000']),
            ),
        ];
    }
}
