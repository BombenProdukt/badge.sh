<?php

declare(strict_types=1);

namespace App\Badges\Cirrus\Badges;

use App\Enums\Category;

final class GitHubBadge extends AbstractBadge
{
    protected array $routes = [
        '/cirrus/github/{owner}/{repo}/{branch?}',
    ];

    protected array $keywords = [
        Category::BUILD,
    ];

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

    public function routeRules(): array
    {
        return [
            'script' => ['string'],
            'task' => ['string'],
        ];
    }

    public function previews(): array
    {
        return [
            '/cirrus/github/flutter/flutter' => 'build status',
            '/cirrus/github/flutter/flutter/master' => 'build status',
            '/cirrus/github/flutter/flutter/master?task=build_docker' => 'build status',
            '/cirrus/github/flutter/flutter/master?task=build_docker&script=test' => 'build status',
        ];
    }
}
