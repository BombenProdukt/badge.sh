<?php

declare(strict_types=1);

namespace App\Badges\GitLab\Badges;

use App\Badges\GitLab\Client;
use App\Contracts\Badge;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;
use PreemStudio\Formatter\FormatNumber;

final class CommitsBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $repo, ?string $ref = null): array
    {
        $response = $this->client->rest($repo, $ref ? "repository/commits?ref={$ref}" : 'repository/commits');

        return [
            'label'        => 'commits',
            'message'      => FormatNumber::execute((int) $response->header('x-total')),
            'messageColor' => 'blue.600',
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
            '/gitlab/{repo}/commits/{ref?}',
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
            '/gitlab/cryptsetup/cryptsetup/commits'                                                  => 'commits count',
            '/gitlab/cryptsetup/cryptsetup/commits/coverity_scan'                                    => 'commits count (branch ref)',
            '/gitlab/cryptsetup/cryptsetup/commits/v2.2.2'                                           => 'commits count (tag ref)',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
