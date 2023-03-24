<?php

declare(strict_types=1);

namespace App\Badges\GitHub\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class ReleasesBadge extends AbstractBadge
{
    public function handle(string $owner, string $repo): array
    {
        return [
            'count' => $this->client->makeRepoQuery($owner, $repo, 'releases { totalCount }')['releases']['totalCount'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('releases', $properties['count']);
    }

    public function keywords(): array
    {
        return [Category::VERSION];
    }

    public function routePaths(): array
    {
        return [
            '/github/releases/{owner}/{repo}',
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
            '/github/releases/micromatch/micromatch' => 'releases',
        ];
    }
}
