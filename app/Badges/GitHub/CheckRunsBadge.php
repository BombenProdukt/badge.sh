<?php

declare(strict_types=1);

namespace App\Badges\GitHub;

use App\Data\BadgePreviewData;
use App\Enums\Category;
use Github\Client;
use GrahamCampbell\GitHub\Facades\GitHub;
use Illuminate\Support\Collection;

final class CheckRunsBadge extends AbstractBadge
{
    protected string $route = '/github/check-runs/{owner}/{repo}/{reference?}/{context:wildcard?}';

    protected array $keywords = [
        Category::ANALYSIS,
    ];

    public function handle(string $owner, string $repo, ?string $reference = null, ?string $context = null)
    {
        if (empty($reference)) {
            $response = GitHub::connection()->api('repo')->show($owner, $repo);
            $reference = $response['default_branch'];
        }

        /** @var Client */
        $client = GitHub::connection();

        $state = collect($client->repo()->checkRuns()->allForReference($owner, $repo, $reference)['check_runs']);

        if (\is_string($context)) {
            $state = $state->filter(function (array $check) use ($context): bool {
                $checkName = \str_contains(\mb_strtolower($check['name']), $context);
                $appName = \str_contains(\mb_strtolower($check['app']['slug']), $context);

                return $checkName || $appName;
            });
        }

        if ($state instanceof Collection) {
            $state = $this->combineStates($state, 'conclusion');
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
                'label' => $properties['context'] ?: 'checks',
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
            'label' => 'checks',
            'message' => 'unknown',
            'messageColor' => 'gray.600',
        ];
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'combined checks (default branch)',
                path: '/github/check-runs/tunnckoCore/opensource',
                data: $this->render(['context' => 'lint', 'state' => 'pending']),
            ),
            new BadgePreviewData(
                name: 'combined checks (default branch)',
                path: '/github/check-runs/node-formidable/node-formidable',
                data: $this->render(['context' => 'lint', 'state' => 'success']),
            ),
            new BadgePreviewData(
                name: 'single checks (lint job)',
                path: '/github/check-runs/node-formidable/node-formidable/master/lint',
                data: $this->render(['context' => 'lint', 'state' => 'failure']),
            ),
            new BadgePreviewData(
                name: 'single checks (test job)',
                path: '/github/check-runs/node-formidable/node-formidable/master/test',
                data: $this->render(['context' => 'lint', 'state' => 'error']),
            ),
            new BadgePreviewData(
                name: 'single checks (linux)',
                path: '/github/check-runs/node-formidable/node-formidable/master/ubuntu?label=linux',
                data: $this->render(['context' => 'lint', 'state' => 'unknown']),
            ),
            new BadgePreviewData(
                name: 'single checks (windows)',
                path: '/github/check-runs/node-formidable/node-formidable/master/windows',
                data: $this->render(['context' => 'lint', 'state' => 'success']),
            ),
            new BadgePreviewData(
                name: 'single checks (macos)',
                path: '/github/check-runs/node-formidable/node-formidable/master/macos',
                data: $this->render(['context' => 'lint', 'state' => 'success']),
            ),
            new BadgePreviewData(
                name: 'combined checks (branch)',
                path: '/github/check-runs/styfle/packagephobia/main',
                data: $this->render(['context' => 'lint', 'state' => 'success']),
            ),
        ];
    }
}
