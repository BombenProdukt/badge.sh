<?php

declare(strict_types=1);

namespace App\Badges\Cirrus\Badges;

use App\Badges\Cirrus\Client;
use App\Badges\Templates\StatusTemplate;
use App\Contracts\Badge;
use Illuminate\Routing\Route;

final class GitHubBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $owner, string $repo, ?string $branch = null): array
    {
        return StatusTemplate::make('build', $this->client->github($owner, $repo, $branch, request('task'), request('script')));
    }

    public function service(): string
    {
        return 'Cirrus';
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
            '/cirrus/{owner}/{repo}/{branch?}',
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
            '/cirrus/flutter/flutter'                                      => 'build status',
            '/cirrus/flutter/flutter/master'                               => 'build status',
            '/cirrus/flutter/flutter/master?task=build_docker'             => 'build status',
            '/cirrus/flutter/flutter/master?task=build_docker&script=test' => 'build status',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
