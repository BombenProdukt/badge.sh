<?php

declare(strict_types=1);

namespace App\Badges\Packagist;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class GitHubIssuesBadge extends AbstractBadge
{
    protected string $route = '/packagist/github-open-issues/{vendor}/{project}';

    protected array $keywords = [
        Category::ISSUE_TRACKING,
    ];

    public function handle(string $vendor, string $project): array
    {
        return [
            'issues' => $this->client->get($vendor, $project)['github_open_issues'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('github issues', $properties['issues']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'github issues',
                path: '/packagist/github-open-issues/monolog/monolog',
                data: $this->render(['issues' => 1000000000]),
            ),
        ];
    }
}
