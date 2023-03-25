<?php

declare(strict_types=1);

namespace App\Badges\Bitbucket\Badges;

use App\Enums\Category;

final class OpenPullRequestsBadge extends AbstractBadge
{
    protected array $routes = [
        '/bitbucket/open-pull-requests/{user}/{repo}',
    ];

    protected array $keywords = [
        Category::ACTIVITY,
    ];

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
