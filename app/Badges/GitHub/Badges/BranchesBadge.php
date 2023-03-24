<?php

declare(strict_types=1);

namespace App\Badges\GitHub\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class BranchesBadge extends AbstractBadge
{
    public function handle(string $owner, string $repo): array
    {
        return [
            'count' => $this->client->makeRepoQuery($owner, $repo, 'refs(first: 0, refPrefix: "refs/heads/") { totalCount }')['refs']['totalCount'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('branches', $properties['count']);
    }

    public function keywords(): array
    {
        return [Category::ACTIVITY];
    }

    public function routePaths(): array
    {
        return [
            '/github/branches/{owner}/{repo}',
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
            '/github/branches/micromatch/micromatch' => 'branches',
        ];
    }
}
