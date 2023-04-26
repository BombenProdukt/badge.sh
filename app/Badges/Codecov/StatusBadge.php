<?php

declare(strict_types=1);

namespace App\Badges\Codecov;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class StatusBadge extends AbstractBadge
{
    protected string $route = '/codecov/coverage/{service:bitbucket,github,gitlab}/{user}/{repo}/{branch?}';

    protected array $keywords = [
        Category::ANALYSIS, Category::COVERAGE,
    ];

    public function handle(string $service, string $user, string $repo, ?string $branch = null): array
    {
        return [
            'coverage' => $this->client->get($service, $user, $repo, $branch)['commit']['totals']['c'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderCoverage($properties['coverage']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'coverage (github)',
                path: '/codecov/coverage/github/babel/babel',
                data: $this->render(['coverage' => '100']),
            ),
            new BadgePreviewData(
                name: 'coverage (github, branch)',
                path: '/codecov/coverage/github/babel/babel/6.x',
                data: $this->render(['coverage' => '100']),
            ),
            new BadgePreviewData(
                name: 'coverage (bitbucket)',
                path: '/codecov/coverage/bitbucket/ignitionrobotics/ign-math',
                data: $this->render(['coverage' => '100']),
            ),
            new BadgePreviewData(
                name: 'coverage (bitbucket, branch)',
                path: '/codecov/coverage/bitbucket/ignitionrobotics/ign-math/master',
                data: $this->render(['coverage' => '100']),
            ),
            new BadgePreviewData(
                name: 'coverage (gitlab)',
                path: '/codecov/coverage/gitlab/gitlab-org/gitaly',
                data: $this->render(['coverage' => '100']),
            ),
            new BadgePreviewData(
                name: 'coverage (gitlab, branch)',
                path: '/codecov/coverage/gitlab/gitlab-org/gitaly/master',
                data: $this->render(['coverage' => '100']),
            ),
        ];
    }
}
