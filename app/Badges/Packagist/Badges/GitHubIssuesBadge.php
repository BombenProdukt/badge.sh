<?php

declare(strict_types=1);

namespace App\Badges\Packagist\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class GitHubIssuesBadge extends AbstractBadge
{
    protected array $routes = [
        '/packagist/github-open-issues/{package:packageWithVendorOnly}',
    ];

    protected array $keywords = [
        Category::ISSUE_TRACKING,
    ];

    public function handle(string $package, ?string $channel = null): array
    {
        return [
            'issues' => $this->client->get($package)['github_open_issues'],
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
