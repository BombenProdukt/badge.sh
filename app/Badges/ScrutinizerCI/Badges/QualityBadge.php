<?php

declare(strict_types=1);

namespace App\Badges\ScrutinizerCI\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class QualityBadge extends AbstractBadge
{
    public function handle(string $vcs, string $user, string $repo, ?string $branch = 'master'): array
    {
        return [
            'quality' => $this->client->get($vcs, $user, $repo)['applications'][$branch]['index']['_embedded']['project']['metric_values']['scrutinizer.quality'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('quality', $properties['quality']);
    }

    public function keywords(): array
    {
        return [Category::ANALYSIS];
    }

    public function routePaths(): array
    {
        return [
            '/scrutinizer-ci/quality/{vcs}/{user}/{repo}/{branch?}',
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
            '/scrutinizer-ci/quality/g/filp/whoops' => 'quality',
        ];
    }
}
