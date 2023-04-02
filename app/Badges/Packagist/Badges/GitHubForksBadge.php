<?php

declare(strict_types=1);

namespace App\Badges\Packagist\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class GitHubForksBadge extends AbstractBadge
{
    protected string $route = '/packagist/github-forks/{vendor}/{project}';

    protected array $keywords = [
        Category::SOCIAL,
    ];

    public function handle(string $vendor, string $project): array
    {
        return [
            'forks' => $this->client->get($vendor, $project)['github_forks'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('github forks', $properties['forks']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'github followers',
                path: '/packagist/github-forks/monolog/monolog',
                data: $this->render(['forks' => 1000000000]),
            ),
        ];
    }
}
