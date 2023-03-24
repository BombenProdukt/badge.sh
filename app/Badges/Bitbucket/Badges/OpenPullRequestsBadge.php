<?php

declare(strict_types=1);

namespace App\Badges\Bitbucket\Badges;

use App\Enums\Category;

final class OpenPullRequestsBadge extends AbstractBadge
{
    public function handle(string $user, string $repo): array
    {
        return [
            'count' => $this->client->pullRequests($user, $repo),
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('open pull requests', $properties['count']);
    }

    public function keywords(): array
    {
        return [Category::ACTIVITY];
    }

    public function routePaths(): array
    {
        return [
            '/bitbucket/open-pull-requests/{user}/{repo}',
        ];
    }

    public function routeParameters(): array
    {
        return [];
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/bitbucket/open-pull-requests/atlassian/adf-builder-javascript' => 'open pull requests',
        ];
    }
}
