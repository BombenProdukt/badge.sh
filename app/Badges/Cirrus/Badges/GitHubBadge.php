<?php

declare(strict_types=1);

namespace App\Badges\Cirrus\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class GitHubBadge extends AbstractBadge
{
    public function handle(string $owner, string $repo, ?string $branch = null): array
    {
        return [
            'status' => $this->client->github($owner, $repo, $branch, $this->getRequestData('task'), $this->getRequestData('script')),
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderStatus('build', $properties['status']);
    }

    public function keywords(): array
    {
        return [Category::BUILD];
    }

    public function routePaths(): array
    {
        return [
            '/cirrus/github/{owner}/{repo}/{branch?}',
        ];
    }

    public function routeRules(): array
    {
        return [
            'script' => ['string'],
            'task' => ['string'],
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
            '/cirrus/github/flutter/flutter' => 'build status',
            '/cirrus/github/flutter/flutter/master' => 'build status',
            '/cirrus/github/flutter/flutter/master?task=build_docker' => 'build status',
            '/cirrus/github/flutter/flutter/master?task=build_docker&script=test' => 'build status',
        ];
    }
}
