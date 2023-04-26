<?php

declare(strict_types=1);

namespace App\Badges\GitHub;

use App\Data\BadgePreviewData;
use App\Enums\Category;
use Github\Client;
use GrahamCampbell\GitHub\Facades\GitHub;
use Illuminate\Support\Collection;

final class CheckStatusBadge extends AbstractBadge
{
    protected string $route = '/github/check-status/{owner}/{repo}/{reference?}/{context:wildcard?}';

    protected array $keywords = [
        Category::BUILD,
    ];

    public function handle(string $owner, string $repo, ?string $reference = null, ?string $context = null): array
    {
        if (empty($reference)) {
            $response = GitHub::connection()->api('repo')->show($owner, $repo);
            $reference = $response['default_branch'];
        }

        /** @var Client */
        $client = GitHub::connection();

        $response = $client->repo()->statuses()->combined($owner, $repo, $reference);

        if (\is_string($context)) {
            $state = collect($response['statuses'])->filter(fn (array $check) => \str_contains(\mb_strtolower($check['context']), $context));
        } else {
            $state = $response['state'];
        }

        if ($state instanceof Collection) {
            $state = $this->combineStates($state, 'state');
        }

        return [
            'context' => $context,
            'state' => $state,
        ];
    }

    public function render(array $properties): array
    {
        if (\is_string($properties['state'])) {
            return [
                'label' => $properties['context'] ?: 'status',
                'message' => $properties['state'],
                'messageColor' => [
                    'pending' => 'orange.600',
                    'success' => 'green.600',
                    'failure' => 'red.600',
                    'error' => 'red.600',
                    'unknown' => 'gray.600',
                ][$properties['state']],
            ];
        }

        return [
            'label' => 'status',
            'message' => 'unknown',
            'messageColor' => 'gray.600',
        ];
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'combined statuses (default branch)',
                path: '/github/check-status/micromatch/micromatch',
                data: $this->render(['context' => 'ci/circleci', 'state' => 'success']),
            ),
            new BadgePreviewData(
                name: 'combined statuses (branch)',
                path: '/github/check-status/micromatch/micromatch/gh-pages',
                data: $this->render(['context' => 'ci/circleci', 'state' => 'success']),
            ),
            new BadgePreviewData(
                name: 'combined statuses (commit)',
                path: '/github/check-status/micromatch/micromatch/f4809eb6df80b',
                data: $this->render(['context' => 'ci/circleci', 'state' => 'success']),
            ),
            new BadgePreviewData(
                name: 'combined statuses (tag)',
                path: '/github/check-status/micromatch/micromatch/4.0.1',
                data: $this->render(['context' => 'ci/circleci', 'state' => 'success']),
            ),
            new BadgePreviewData(
                name: 'single status',
                path: '/github/check-status/facebook/react/main/ci/circleci:%20yarn_test',
                data: $this->render(['context' => 'ci/circleci', 'state' => 'success']),
            ),
            new BadgePreviewData(
                name: 'combined statuses (ci*)',
                path: '/github/check-status/zeit/hyper/master/ci',
                data: $this->render(['context' => 'ci/circleci', 'state' => 'success']),
            ),
            new BadgePreviewData(
                name: 'combined statuses (ci/circleci*)',
                path: '/github/check-status/zeit/hyper/master/ci/circleci',
                data: $this->render(['context' => 'ci/circleci', 'state' => 'success']),
            ),
            new BadgePreviewData(
                name: 'single status',
                path: '/github/check-status/zeit/hyper/master/ci/circleci:%20build',
                data: $this->render(['context' => 'ci/circleci', 'state' => 'success']),
            ),
        ];
    }
}
