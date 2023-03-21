<?php

declare(strict_types=1);

namespace App\Badges\GitHub\Badges;

use App\Badges\GitHub\Actions\RequestDependents;
use App\Contracts\Badge;
use Illuminate\Routing\Route;

final class RepositoryDependentsBadge implements Badge
{
    public function handle(string $owner, string $repo): array
    {
        return RequestDependents::execute($owner, $repo, 'REPOSITORY');
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
            '/github/dependents-repo/{owner}/{repo}',
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
            '/github/dependents-repo/micromatch/micromatch' => 'repository dependents',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
