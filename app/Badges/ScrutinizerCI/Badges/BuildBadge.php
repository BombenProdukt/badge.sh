<?php

declare(strict_types=1);

namespace App\Badges\ScrutinizerCI\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class BuildBadge extends AbstractBadge
{
    public function handle(string $vcs, string $user, string $repo, ?string $branch = 'master'): array
    {
        return $this->client->get($vcs, $user, $repo)['applications'][$branch]['build_status'];
    }

    public function render(array $properties): array
    {
        return $this->renderStatus('build', $properties['status']);
    }

    public function keywords(): array
    {
        return [Category::ANALYSIS];
    }

    public function routePaths(): array
    {
        return [
            '/scrutinizer-ci/build/{vcs}/{user}/{repo}/{branch?}',
        ];
    }

    public function routeParameters(): array
    {
        return [];
    }

    public function routeConstraints(Route $route): void
    {
        $route->whereIn('vcs', ['g', 'gl', 'b']);
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/scrutinizer-ci/build/g/filp/whoops' => 'build',
        ];
    }
}
