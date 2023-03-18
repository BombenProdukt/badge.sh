<?php

declare(strict_types=1);

namespace App\Badges\GitHub\Badges;

use App\Actions\FormatNumber;
use App\Badges\GitHub\Client;
use App\Contracts\Badge;
use Illuminate\Routing\Route;

final class StarsBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $owner, string $repo): array
    {
        $result = $this->client->makeRepoQuery($owner, $repo, 'stargazers { totalCount }');

        return [
            'label'       => 'stars',
            'status'      => FormatNumber::execute($result['stargazers']['totalCount']),
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
            '/github/stars/{owner}/{repo}',
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
            '/github/stars/micromatch/micromatch' => 'stars',

        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
