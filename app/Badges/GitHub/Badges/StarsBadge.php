<?php

declare(strict_types=1);

namespace App\Badges\GitHub\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class StarsBadge extends AbstractBadge
{
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

    public function keywords(): array
    {
        return [Category::RATING];
    }

    public function routePaths(): array
    {
        return [
            '/github/stars/{owner}/{repo}',
        ];
    }

    public function routeParameters(): array
    {
        return [];
    }

    public function routeConstraints(Route $route): void
    {
        //
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
