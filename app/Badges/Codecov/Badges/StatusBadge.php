<?php

declare(strict_types=1);

namespace App\Badges\Codecov\Badges;

use App\Actions\ExtractCoverageColor;
use App\Actions\FormatPercentage;
use App\Badges\Codecov\Client;
use App\Contracts\Badge;
use Illuminate\Routing\Route;

final class StatusBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $service, string $owner, string $repo, ?string $branch = null): array
    {
        $response = $this->client->get($service, $owner, $repo, $branch);
        $coverage = (float) $response['commit']['totals']['c'];

        return [
            'label'       => 'coverage',
            'status'      => FormatPercentage::execute($coverage),
            'statusColor' => ExtractCoverageColor::execute($coverage),
        ];
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
            '/codecov/c/{service}/{owner}/{repo}/{branch?}',
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
        $route->whereIn('service', ['gh', 'github', 'bitbucket', 'gitlab']);
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
            '/codecov/c/github/babel/babel'                         => 'coverage (github)',
            '/codecov/c/github/babel/babel/6.x'                     => 'coverage (github, branch)',
            '/codecov/c/bitbucket/ignitionrobotics/ign-math'        => 'coverage (bitbucket)',
            '/codecov/c/bitbucket/ignitionrobotics/ign-math/master' => 'coverage (bitbucket, branch)',
            '/codecov/c/gitlab/gitlab-org/gitaly'                   => 'coverage (gitlab)',
            '/codecov/c/gitlab/gitlab-org/gitaly/master'            => 'coverage (gitlab, branch)',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
