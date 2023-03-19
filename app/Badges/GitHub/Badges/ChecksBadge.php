<?php

declare(strict_types=1);

namespace App\Badges\GitHub\Badges;

use App\Badges\GitHub\Actions\CombineStates;
use App\Contracts\Badge;
use App\Enums\RoutePattern;
use GrahamCampbell\GitHub\Facades\GitHub;
use Illuminate\Routing\Route;
use Illuminate\Support\Collection;

final class ChecksBadge implements Badge
{
    public function handle(string $owner, string $repo, ?string $reference = '', ?string $context = '')
    {
        [$owner, $repo] = explode('/', $repo);

        if (empty($reference)) {
            $response  = GitHub::connection('main')->api('repo')->show($owner, $repo);
            $reference = $response['default_branch'];
        }

        $response = GitHub::connection('main')->api('repo')->checkRuns()->allForReference($owner, $repo, $reference);

        $state = collect($response['check_runs']);

        if (is_string($context)) {
            $state = $state->filter(function (array $check) use ($context): bool {
                $checkName = str_contains(strtolower($check['name']), $context);
                $appName   = str_contains(strtolower($check['app']['slug']), $context);

                return $checkName || $appName;
            });
        }

        if ($state instanceof Collection) {
            $state = CombineStates::execute($state, 'conclusion');
        }

        if (is_string($state)) {
            return [
                'label'        => $context ?: 'checks',
                'message'      => $state,
                'messageColor' => [
                    'pending' => 'orange.600',
                    'success' => 'green.600',
                    'failure' => 'red.600',
                    'error'   => 'red.600',
                    'unknown' => 'gray.600',
                ][$state],
            ];
        }

        return [
            'label'        => 'checks',
            'message'      => 'unknown',
            'messageColor' => 'gray.600',
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
            '/github/{owner}/{repo}/checks/{reference?}/{context?}',
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
            '/github/tunnckoCore/opensource/checks'                                    => 'combined checks (default branch)',
            '/github/node-formidable/node-formidable/checks'                           => 'combined checks (default branch)',
            '/github/node-formidable/node-formidable/checks/master/lint'               => 'single checks (lint job)',
            '/github/node-formidable/node-formidable/checks/master/test'               => 'single checks (test job)',
            '/github/node-formidable/node-formidable/checks/master/ubuntu?label=linux' => 'single checks (linux)',
            '/github/node-formidable/node-formidable/checks/master/windows'            => 'single checks (windows)',
            '/github/node-formidable/node-formidable/checks/master/macos'              => 'single checks (macos)',
            '/github/styfle/packagephobia/checks/main'                                 => 'combined checks (branch)',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
