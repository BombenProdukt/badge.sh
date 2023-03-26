<?php

declare(strict_types=1);

namespace App\Badges\Packagist\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class GitHubStarsBadge extends AbstractBadge
{
    protected array $routes = [
        '/packagist/github-stars/{package:wildcard}',
    ];

    protected array $keywords = [
        Category::RATING,
    ];

    public function handle(string $package, ?string $channel = null): array
    {
        return [
            'stars' => $this->client->get($package)['github_stars'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('github stars', $properties['stars']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'github stars',
                path: '/packagist/github-stars/monolog/monolog',
                data: $this->render(['stars' => '4.5']),
            ),
        ];
    }
}
