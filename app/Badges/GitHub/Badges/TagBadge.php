<?php

declare(strict_types=1);

namespace App\Badges\GitHub\Badges;

use App\Actions\ExtractVersion;
use App\Badges\GitHub\Client;
use App\Contracts\Badge;
use Illuminate\Routing\Route;

final class TagBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $owner, string $repo): array
    {
        $result    = $this->client->makeRepoQuery($owner, $repo, 'refs(last: 1, refPrefix: "refs/tags/", orderBy: { field: TAG_COMMIT_DATE, direction: ASC }) { edges { node { name } } }');
        $tags      = $result['refs']['edges'];
        $latestTag = count($tags) > 0 ? $tags[0]['node']['name'] : null;

        return [
            'label'       => 'latest tag',
            'status'      => ExtractVersion::execute($latestTag),
            'statusColor' => 'blue.600',
        ];
    }

    public function service(): string
    {
        return 'GitHub';
    }

    public function title(): string
    {
        return '';
    }

    public function keywords(): array
    {
        return [
            //
        ];
    }

    public function routePaths(): array
    {
        return [
            '/github/{owner}/{repo}/tag',
        ];
    }

    public function routeParameters(): array
    {
        return [
            //
        ];
    }

    public function routeConstraints(Route $route): void
    {
        //
    }

    public function staticPreviews(): array
    {
        return [
            //
        ];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/github/micromatch/micromatch/tag' => 'latest tag',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
