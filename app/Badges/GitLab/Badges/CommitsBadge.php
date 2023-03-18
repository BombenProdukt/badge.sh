<?php

declare(strict_types=1);

namespace App\Badges\GitLab\Badges;

use App\Actions\FormatNumber;
use App\Badges\GitLab\Client;
use App\Contracts\Badge;
use Illuminate\Routing\Route;

final class CommitsBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $owner, string $repo, ?string $ref = null): array
    {
        $response = $this->client->rest($owner, $repo, $ref ? "repository/commits?ref={$ref}" : 'repository/commits');

        return [
            'label'       => 'commits',
            'status'      => FormatNumber::execute((int) $response->header('x-total')),
            'statusColor' => 'blue.600',
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
            '/gitlab/commits/{owner}/{repo}/{ref?}',
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
            '/gitlab/commits/cryptsetup/cryptsetup'                                                  => 'commits count',
            '/gitlab/commits/cryptsetup/cryptsetup/coverity_scan'                                    => 'commits count (branch ref)',
            '/gitlab/commits/cryptsetup/cryptsetup/v2.2.2'                                           => 'commits count (tag ref)',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
