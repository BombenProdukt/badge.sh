<?php

declare(strict_types=1);

namespace App\Badges\GitLab;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class MergeRequestsBadge extends AbstractBadge
{
    protected string $route = '/gitlab/merge-requests/{repo:wildcard}';

    protected array $keywords = [
        Category::ISSUE_TRACKING,
    ];

    public function handle(string $repo): array
    {
        return [
            'count' => $this->client->rest($repo, 'merge_requests')->header('x-total'),
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('MRs', $properties['count']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'MRs',
                path: '/gitlab/merge-requests/edouardklein/falsisign',
                data: $this->render(['count' => '1000']),
            ),
        ];
    }
}
