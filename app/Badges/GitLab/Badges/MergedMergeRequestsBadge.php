<?php

declare(strict_types=1);

namespace App\Badges\GitLab\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class MergedMergeRequestsBadge extends AbstractBadge
{
    protected string $route = '/gitlab/merged-merge-requests/{repo:wildcard}';

    protected array $keywords = [
        Category::ISSUE_TRACKING,
    ];

    public function handle(string $repo): array
    {
        return [
            'count' => $this->client->rest($repo, 'merge_requests?state=merged')->header('x-total'),
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('', $properties['count']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'merged MRs',
                path: '/gitlab/merged-merge-requests/edouardklein/falsisign',
                data: $this->render(['count' => '42']),
            ),
        ];
    }
}
