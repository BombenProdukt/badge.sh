<?php

declare(strict_types=1);

namespace App\Badges\Codecov\Badges;

use App\Badges\Codecov\Client;
use App\Badges\Templates\CoverageTemplate;
use App\Contracts\Badge;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class StatusBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $service, string $repo, ?string $branch = null): array
    {
        $response = $this->client->get($service, $repo, $branch);

        return CoverageTemplate::make($response['commit']['totals']['c']);
    }

    public function service(): string
    {
        return 'Codecov';
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
            '/codecov/coverage/{service}/{repo}/{branch?}',
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
        $route->whereIn('service', ['github', 'bitbucket', 'gitlab']);
        $route->where('repo', RoutePattern::CATCH_ALL->value);
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
            '/codecov/coverage/github/babel/babel'                         => 'coverage (github)',
            '/codecov/coverage/github/babel/babel/6.x'                     => 'coverage (github, branch)',
            '/codecov/coverage/bitbucket/ignitionrobotics/ign-math'        => 'coverage (bitbucket)',
            '/codecov/coverage/bitbucket/ignitionrobotics/ign-math/master' => 'coverage (bitbucket, branch)',
            '/codecov/coverage/gitlab/gitlab-org/gitaly'                   => 'coverage (gitlab)',
            '/codecov/coverage/gitlab/gitlab-org/gitaly/master'            => 'coverage (gitlab, branch)',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
