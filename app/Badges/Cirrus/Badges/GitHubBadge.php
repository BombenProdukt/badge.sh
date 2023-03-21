<?php

declare(strict_types=1);

namespace App\Badges\Cirrus\Badges;

use App\Badges\AbstractBadge;
use App\Badges\Cirrus\Client;
use App\Badges\Templates\StatusTemplate;
use Illuminate\Routing\Route;

final class GitHubBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $owner, string $repo, ?string $branch = null): array
    {
        return StatusTemplate::make('build', $this->client->github($owner, $repo, $branch, $this->request->query('task'), $this->request->query('script')));
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
        return [];
    }

    public function routePaths(): array
    {
        return [
            '/cirrus/github/{owner}/{repo}/{branch?}',
        ];
    }

    public function routeParameters(): array
    {
        return [];
    }

    public function routeConstraints(Route $route): void
    {
        //
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/cirrus/github/flutter/flutter'                                      => 'build status',
            '/cirrus/github/flutter/flutter/master'                               => 'build status',
            '/cirrus/github/flutter/flutter/master?task=build_docker'             => 'build status',
            '/cirrus/github/flutter/flutter/master?task=build_docker&script=test' => 'build status',
        ];
    }
}
