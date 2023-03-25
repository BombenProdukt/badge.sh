<?php

declare(strict_types=1);

namespace App\Badges\GitHub\Badges;

use App\Badges\GitHub\Actions\CombineStates;
use App\Enums\Category;
use App\Enums\RoutePattern;
use GrahamCampbell\GitHub\Facades\GitHub;
use Illuminate\Routing\Route;
use Illuminate\Support\Collection;

final class CheckRunsBadge extends AbstractBadge
{
    /**
     * The routes to access this badge.
     *
     * @var array<int, string>
     */
    protected array $routes = [
        '/github/check-runs/{owner}/{repo}/{reference?}/{context?}',
    ];

    /**
     * The keywords that describe this badge.
     *
     * @var array<int, string>
     */
    protected array $keywords = [
        Category::ANALYSIS,
    ];

    public function handle(string $owner, string $repo, ?string $reference = '', ?string $context = '')
    {
        if (empty($reference)) {
            $response = GitHub::connection('main')->api('repo')->show($owner, $repo);
            $reference = $response['default_branch'];
        }

        $response = GitHub::connection('main')->api('repo')->checkRuns()->allForReference($owner, $repo, $reference);

        $state = collect($response['check_runs']);

        if (\is_string($context)) {
            $state = $state->filter(function (array $check) use ($context): bool {
                $checkName = \str_contains(\mb_strtolower($check['name']), $context);
                $appName = \str_contains(\mb_strtolower($check['app']['slug']), $context);

                return $checkName || $appName;
            });
        }

        if ($state instanceof Collection) {
            $state = CombineStates::execute($state, 'conclusion');
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

    public function routeConstraints(Route $route): void
    {
        $route->where('context', RoutePattern::CATCH_ALL->value);
        //
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/github/check-runs/tunnckoCore/opensource' => 'combined checks (default branch)',
            '/github/check-runs/node-formidable/node-formidable' => 'combined checks (default branch)',
            '/github/check-runs/node-formidable/node-formidable/master/lint' => 'single checks (lint job)',
            '/github/check-runs/node-formidable/node-formidable/master/test' => 'single checks (test job)',
            '/github/check-runs/node-formidable/node-formidable/master/ubuntu?label=linux' => 'single checks (linux)',
            '/github/check-runs/node-formidable/node-formidable/master/windows' => 'single checks (windows)',
            '/github/check-runs/node-formidable/node-formidable/master/macos' => 'single checks (macos)',
            '/github/check-runs/styfle/packagephobia/main' => 'combined checks (branch)',
        ];
    }
}
