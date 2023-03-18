<?php

declare(strict_types=1);

namespace App\Badges\GitHub\Badges;

use App\Badges\GitHub\Actions\CombineStates;
use App\Badges\GitHub\Client;
use App\Contracts\Badge;
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
            '/github/status/{owner}/{repo}/{reference?}/{context?}',
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
        $route->where('context', '.+');
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
            '/github/status/micromatch/micromatch'                        => 'combined statuses (default branch)',
            '/github/status/micromatch/micromatch/gh-pages'               => 'combined statuses (branch)',
            '/github/status/micromatch/micromatch/f4809eb6df80b'          => 'combined statuses (commit)',
            '/github/status/micromatch/micromatch/4.0.1'                  => 'combined statuses (tag)',
            '/github/status/facebook/react/main/ci/circleci:%20yarn_test' => 'single status',
            '/github/status/zeit/hyper/master/ci'                         => 'combined statuses (ci*)',
            '/github/status/zeit/hyper/master/ci/circleci'                => 'combined statuses (ci/circleci*)',
            '/github/status/zeit/hyper/master/ci/circleci:%20build'       => 'single status',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
