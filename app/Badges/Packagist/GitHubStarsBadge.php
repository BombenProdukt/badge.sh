<?php

declare(strict_types=1);

namespace App\Badges\Packagist;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class GitHubStarsBadge extends AbstractBadge
{
    protected string $route = '/packagist/github-stars/{vendor}/{project}';

    protected array $keywords = [
        Category::RATING,
    ];

    public function handle(string $vendor, string $project): array
    {
        return [
            'stars' => $this->client->get($vendor, $project)['github_stars'],
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
