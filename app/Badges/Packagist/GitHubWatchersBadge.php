<?php

declare(strict_types=1);

namespace App\Badges\Packagist;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class GitHubWatchersBadge extends AbstractBadge
{
    protected string $route = '/packagist/github-watchers/{vendor}/{project}';

    protected array $keywords = [
        Category::SOCIAL,
    ];

    public function handle(string $vendor, string $project): array
    {
        return [
            'watchers' => $this->client->get($vendor, $project)['github_watchers'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('github watchers', $properties['watchers']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'github watchers',
                path: '/packagist-github/watchers/monolog/monolog',
                data: $this->render(['watchers' => 1000000000]),
            ),
        ];
    }
}
