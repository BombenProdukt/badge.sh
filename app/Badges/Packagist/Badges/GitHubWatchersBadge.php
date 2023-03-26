<?php

declare(strict_types=1);

namespace App\Badges\Packagist\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class GitHubWatchersBadge extends AbstractBadge
{
    protected array $routes = [
        '/packagist/github-watchers/{package:wildcard}',
    ];

    protected array $keywords = [
        Category::SOCIAL,
    ];

    public function handle(string $package, ?string $channel = null): array
    {
        return [
            'watchers' => $this->client->get($package)['github_watchers'],
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
