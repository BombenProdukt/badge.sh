<?php

declare(strict_types=1);

namespace App\Badges\ScrutinizerCI\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;
use Illuminate\Routing\Route;

final class CoverageBadge extends AbstractBadge
{
    protected array $routes = [
        '/scrutinizer-ci/coverage/{vcs}/{user}/{repo}/{branch?}',
    ];

    protected array $keywords = [
        Category::ANALYSIS,
    ];

    public function handle(string $vcs, string $user, string $repo, ?string $branch = 'master'): array
    {
        return [
            'count' => $this->client->get($vcs, $user, $repo)['applications'][$branch]['index']['_embedded']['project']['metric_values']['scrutinizer.test_coverage'] * 100,
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderCoverage($properties['percentage']);
    }

    public function routeConstraints(Route $route): void
    {
        $route->whereIn('vcs', ['g', 'gl', 'b']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'coverage',
                path: '/scrutinizer-ci/coverage/g/filp/whoops',
                data: $this->render([]),
            ),
        ];
    }
}
