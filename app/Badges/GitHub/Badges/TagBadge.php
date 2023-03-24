<?php

declare(strict_types=1);

namespace App\Badges\GitHub\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class TagBadge extends AbstractBadge
{
    public function handle(string $owner, string $repo): array
    {
        $result = $this->client->makeRepoQuery($owner, $repo, 'refs(last: 1, refPrefix: "refs/tags/", orderBy: { field: TAG_COMMIT_DATE, direction: ASC }) { edges { node { name } } }');

        return [
            'version' => $result['refs']['edges'][0]['node']['name'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderVersion($properties['version']);
    }

    public function keywords(): array
    {
        return [Category::VERSION];
    }

    public function routePaths(): array
    {
        return [
            '/github/tag/{owner}/{repo}',
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
            '/github/tag/micromatch/micromatch' => 'latest tag',
        ];
    }
}
