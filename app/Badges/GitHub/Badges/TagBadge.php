<?php

declare(strict_types=1);

namespace App\Badges\GitHub\Badges;

use App\Actions\ExtractVersion;
use App\Enums\Category;
use Illuminate\Routing\Route;

final class TagBadge extends AbstractBadge
{
    public function handle(string $owner, string $repo): array
    {
        $result    = $this->client->makeRepoQuery($owner, $repo, 'refs(last: 1, refPrefix: "refs/tags/", orderBy: { field: TAG_COMMIT_DATE, direction: ASC }) { edges { node { name } } }');
        $tags      = $result['refs']['edges'];
        $latestTag = count($tags) > 0 ? $tags[0]['node']['name'] : null;

        return [
            'label'        => 'latest tag',
            'message'      => ExtractVersion::execute($latestTag),
            'messageColor' => 'blue.600',
        ];
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
