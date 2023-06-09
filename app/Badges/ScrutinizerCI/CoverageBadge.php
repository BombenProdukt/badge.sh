<?php

declare(strict_types=1);

namespace App\Badges\ScrutinizerCI;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class CoverageBadge extends AbstractBadge
{
    protected string $route = '/scrutinizer-ci/coverage/{vcs:b,g,gl}/{user}/{repo}/{branch?}';

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

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'coverage',
                path: '/scrutinizer-ci/coverage/g/filp/whoops',
                data: $this->render(['percentage' => '66.66']),
            ),
        ];
    }
}
