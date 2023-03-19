<?php

declare(strict_types=1);

namespace App\Badges\GitLab\Badges;

use App\Badges\GitLab\Client;
use App\Contracts\Badge;
use App\Enums\RoutePattern;
use Carbon\Carbon;
use Illuminate\Routing\Route;

final class LastCommitBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $repo, ?string $ref = null): array
    {
        $response = $this->client->rest($repo, $ref ? "repository/commits?ref={$ref}" : 'repository/commits')->json('0');

        return [
            'label'       => 'last commit',
            'status'      => Carbon::parse($response['committed_date'])->diffForHumans(),
            'statusColor' => 'green.600',
        ];
    }

    public function service(): string
    {
        return 'GitLab';
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
            '/gitlab/{repo}/commits/latest/{ref?}',
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
            '/gitlab/gitlab-org/gitlab-development-kit/commits/latest'                                  => 'last commit',
            '/gitlab/gitlab-org/gitlab-development-kit/commits/latest/updating-chromedriver-install-v2' => 'last commit (branch ref)',
            '/gitlab/gitlab-org/gitlab-development-kit/commits/latest/v0.2.5'                           => 'last commit (tag ref)',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
