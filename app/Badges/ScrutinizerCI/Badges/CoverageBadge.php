<?php

declare(strict_types=1);

namespace App\Badges\ScrutinizerCI\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class CoverageBadge extends AbstractBadge
{
    public function handle(string $vcs, string $user, string $repo, ?string $branch = 'master'): array
    {
        return $this->renderCoverage($this->client->get($vcs, $user, $repo)['applications'][$branch]['index']['_embedded']['project']['metric_values']['scrutinizer.test_coverage'] * 100);
    }

    public function keywords(): array
    {
        return [Category::ANALYSIS];
    }

    public function routePaths(): array
    {
        return [
            '/scrutinizer-ci/coverage/{vcs}/{user}/{repo}/{branch?}',
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
            '/scrutinizer-ci/coverage/g/filp/whoops' => 'coverage',
        ];
    }
}
