<?php

declare(strict_types=1);

namespace App\Badges\GitHub\Badges;

use App\Badges\GitHub\Client;
use App\Contracts\Badge;
use GrahamCampbell\GitHub\Facades\GitHub;
use Illuminate\Routing\Route;

final class ContributorsBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $owner, string $repo): array
    {
        return [
            'label'       => 'contributors',
            'status'      => (string) count(GitHub::api('repo')->contributors($owner, $repo)),
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
            '/github/contributors/{owner}/{repo}',
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
            '/github/contributors/micromatch/micromatch' => 'contributors',

        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
