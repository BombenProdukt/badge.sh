<?php

declare(strict_types=1);

namespace App\Badges\GitHub\Badges;

use App\Actions\FormatNumber;
use App\Badges\GitHub\Client;
use App\Contracts\Badge;
use Illuminate\Routing\Route;

final class MergedPullRequestsBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $owner, string $repo)
    {
        $result = $this->client->makeRepoQuery($owner, $repo, 'pullRequests(states:[MERGED]) { totalCount }');

        return [
            'label'       => 'merged PRs',
            'status'      => FormatNumber::execute($result['pullRequests']['totalCount']),
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
            '/github/merged-prs/{owner}/{repo}',
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
            '/github/merged-prs/micromatch/micromatch' => 'merged PRs',

        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
