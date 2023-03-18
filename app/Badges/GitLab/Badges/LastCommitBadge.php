<?php

declare(strict_types=1);

namespace App\Badges\GitLab\Badges;

use App\Badges\GitLab\Client;
use App\Contracts\Badge;
use Carbon\Carbon;
use Illuminate\Routing\Route;

final class LastCommitBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $owner, string $repo, ?string $ref = null): array
    {
        $response = $this->client->rest($owner, $repo, $ref ? "repository/commits?ref={$ref}" : 'repository/commits')->json('0');

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
            '/gitlab/last-commit/{owner}/{repo}/{ref?}',
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
            '/gitlab/last-commit/gitlab-org/gitlab-development-kit'                                  => 'last commit',
            '/gitlab/last-commit/gitlab-org/gitlab-development-kit/updating-chromedriver-install-v2' => 'last commit (branch ref)',
            '/gitlab/last-commit/gitlab-org/gitlab-development-kit/v0.2.5'                           => 'last commit (tag ref)',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
