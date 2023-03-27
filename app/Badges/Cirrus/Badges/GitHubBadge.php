<?php

declare(strict_types=1);

namespace App\Badges\Cirrus\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class GitHubBadge extends AbstractBadge
{
    protected string $route = '/cirrus/github/{owner}/{repo}/{branch?}';

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
            new BadgePreviewData(
                name: 'build status',
                path: '/cirrus/github/flutter/flutter',
                data: $this->render(['status' => 'passing']),
            ),
            new BadgePreviewData(
                name: 'build status',
                path: '/cirrus/github/flutter/flutter/master',
                data: $this->render(['status' => 'passing']),
            ),
            new BadgePreviewData(
                name: 'build status',
                path: '/cirrus/github/flutter/flutter/master?task=build_docker',
                data: $this->render(['status' => 'passing']),
            ),
            new BadgePreviewData(
                name: 'build status',
                path: '/cirrus/github/flutter/flutter/master?task=build_docker&script=test',
                data: $this->render(['status' => 'passing']),
            ),
        ];
    }
}
