<?php

declare(strict_types=1);

namespace App\Badges\GitHub\Badges;

use App\Badges\GitHub\Actions\RequestDependents;
use App\Enums\Category;

final class RepositoryDependentsBadge extends AbstractBadge
{
    protected array $routes = [
        '/github/dependents-repo/{owner}/{repo}',
    ];

    protected array $keywords = [
        Category::SOCIAL,
    ];

    public function handle(string $owner, string $repo): array
    {
        return RequestDependents::execute($owner, $repo, 'REPOSITORY');
    }

    public function render(array $properties): array
    {
        return $properties;
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
