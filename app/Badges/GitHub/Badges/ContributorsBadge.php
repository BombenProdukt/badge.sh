<?php

declare(strict_types=1);

namespace App\Badges\GitHub\Badges;

use App\Enums\Category;
use GrahamCampbell\GitHub\Facades\GitHub;
use Illuminate\Routing\Route;

final class ContributorsBadge extends AbstractBadge
{
    public function handle(string $owner, string $repo): array
    {
        return [
            'count' => count(GitHub::api('repo')->contributors($owner, $repo)),
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('contributors', $properties['count']);
    }

    public function keywords(): array
    {
        return [Category::SOCIAL];
    }

    public function routePaths(): array
    {
        return [
            '/github/contributors/{owner}/{repo}',
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
            '/github/contributors/micromatch/micromatch' => 'contributors',

        ];
    }
}
