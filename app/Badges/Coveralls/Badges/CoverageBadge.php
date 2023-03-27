<?php

declare(strict_types=1);

namespace App\Badges\Coveralls\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class CoverageBadge extends AbstractBadge
{
    protected string $route = '/coveralls/coverage/{vcs:github,bitbucket}/{repo:packageWithVendorOnly}/{branch?}';

    protected array $keywords = [
        Category::ANALYSIS,
    ];

    public function handle(string $vcs, string $repo, ?string $branch = null): array
    {
        $response = $this->client->get($vcs, $repo, $branch);

        \preg_match('/_(\d+)\.svg/', $response, $matches);

        return [
            'percentage' => $matches[1],
        ];
    }

    public function render(array $properties): array
    {
        if (!\is_numeric($properties['percentage'])) {
            return [
                'subject' => 'coverage',
                'message' => 'invalid',
                'messageColor' => 'gray.600',
            ];
        }

        return $this->renderCoverage($properties['percentage']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'coverage (github)',
                path: '/coveralls/coverage/github/jekyll/jekyll',
                data: $this->render(['percentage' => '66.66']),
            ),
            new BadgePreviewData(
                name: 'coverage (github, branch)',
                path: '/coveralls/coverage/github/jekyll/jekyll/master',
                data: $this->render(['percentage' => '66.66']),
            ),
            new BadgePreviewData(
                name: 'coverage (bitbucket)',
                path: '/coveralls/coverage/bitbucket/pyKLIP/pyklip',
                data: $this->render(['percentage' => '66.66']),
            ),
            new BadgePreviewData(
                name: 'coverage (bitbucket, branch)',
                path: '/coveralls/coverage/bitbucket/pyKLIP/pyklip/master',
                data: $this->render(['percentage' => '66.66']),
            ),
        ];
    }
}
