<?php

declare(strict_types=1);

namespace App\Badges\GitHub\Badges;

use App\Enums\Category;

final class StarsBadge extends AbstractBadge
{
    protected array $routes = [
        '/github/stars/{owner}/{repo}',
    ];

    protected array $keywords = [
        Category::RATING,
    ];

    public function handle(string $owner, string $repo): array
    {
        return [
            'stars' => $this->client->makeRepoQuery($owner, $repo, 'stargazers { totalCount }')['stargazers']['totalCount'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderStars('stars', $properties['stars']);
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/github/stars/micromatch/micromatch' => 'stars',
        ];
    }
}
