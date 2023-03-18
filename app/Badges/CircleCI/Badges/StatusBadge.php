<?php

declare(strict_types=1);

namespace App\Badges\CircleCI\Badges;

use App\Badges\CircleCI\Client;
use App\Contracts\Badge;
use Illuminate\Routing\Route;

final class StatusBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $vcs, string $owner, string $repo, ?string $branch = null): array
    {
        $status = $this->client->get($vcs, $owner, $repo, $branch)[0]['status'];

        return [
            'label'       => 'circleci',
            'status'      => str_replace('_', ' ', $status),
            'statusColor' => ['failed'  => 'red.600', 'success' => 'green.600'][$status] ?? 'gray.600',
        ];
    }

    public function service(): string
    {
        return 'CircleCI';
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
            '/circleci/{vcs}/{owner}/{repo}/{branch?}',
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
        $route->whereIn('vcs', ['github', 'gitlab']);
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
            '/circleci/github/circleci/ex'      => 'build',
            '/circleci/github/circleci/ex/main' => 'build (branch)',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
