<?php

declare(strict_types=1);

namespace App\Badges\GitHub\Badges;

use App\Badges\GitHub\Actions\CombineStates;
use App\Badges\GitHub\Client;
use App\Contracts\Badge;
use App\Enums\RoutePattern;
use GrahamCampbell\GitHub\Facades\GitHub;
use Illuminate\Routing\Route;
use Illuminate\Support\Collection;

final class StatusBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $owner, string $repo, ?string $reference = null, ?string $context = null): array
    {
        if (empty($reference)) {
            $response  = GitHub::connection('main')->api('repo')->show($owner, $repo);
            $reference = $response['default_branch'];
        }

        $response = GitHub::connection('main')->api('repo')->statuses()->combined($owner, $repo, $reference);

        if (is_string($context)) {
            $state = collect($response['statuses'])->filter(fn (array $check) => str_contains(strtolower($check['context']), $context));
        } else {
            $state = $response['state'];
        }

        if ($state instanceof Collection) {
            $state = CombineStates::execute($state, 'state');
        }

        if (is_string($state)) {
            return [
                'label'       => $context ?: 'status',
                'status'      => $state,
                'statusColor' => [
                    'pending' => 'orange.600',
                    'success' => 'green.600',
                    'failure' => 'red.600',
                    'error'   => 'red.600',
                    'unknown' => 'gray.600',
                ][$state],
            ];
        }

        return [
            'label'       => 'status',
            'status'      => 'unknown',
            'statusColor' => 'gray.600',
        ];
    }

    public function service(): string
    {
        return 'GitHub';
    }

    public function title(): string
    {
        return '';
    }

    public function keywords(): array
    {
        return [
            //
        ];
    }

    public function routePaths(): array
    {
        return [
            '/github/{owner}/{repo}/status/{reference?}/{context?}',
        ];
    }

    public function routeParameters(): array
    {
        return [
            //
        ];
    }

    public function routeConstraints(Route $route): void
    {
        $route->where('context', RoutePattern::CATCH_ALL->value);
        //
    }

    public function staticPreviews(): array
    {
        return [
            //
        ];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/github/micromatch/micromatch/status'                        => 'combined statuses (default branch)',
            '/github/micromatch/micromatch/status/gh-pages'               => 'combined statuses (branch)',
            '/github/micromatch/micromatch/status/f4809eb6df80b'          => 'combined statuses (commit)',
            '/github/micromatch/micromatch/status/4.0.1'                  => 'combined statuses (tag)',
            '/github/facebook/react/status/main/ci/circleci:%20yarn_test' => 'single status',
            '/github/zeit/hyper/status/master/ci'                         => 'combined statuses (ci*)',
            '/github/zeit/hyper/status/master/ci/circleci'                => 'combined statuses (ci/circleci*)',
            '/github/zeit/hyper/status/master/ci/circleci:%20build'       => 'single status',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
