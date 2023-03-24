<?php

declare(strict_types=1);

namespace App\Badges\GitHub\Badges;

use App\Badges\GitHub\Actions\RequestDependents;
use App\Enums\Category;
use Illuminate\Routing\Route;

final class RepositoryDependentsBadge extends AbstractBadge
{
    public function handle(string $owner, string $repo): array
    {
        return RequestDependents::execute($owner, $repo, 'REPOSITORY');
    }

    public function render(array $properties): array
    {
        return $properties;
    }

    public function keywords(): array
    {
        return [Category::SOCIAL];
    }

    public function routePaths(): array
    {
        return [
            '/github/dependents-repo/{owner}/{repo}',
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
            '/github/dependents-repo/micromatch/micromatch' => 'repository dependents',
        ];
    }
}
