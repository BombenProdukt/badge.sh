<?php

declare(strict_types=1);

namespace App\Badges\Bitbucket\Badges;

use App\Enums\Category;

final class OpenIssuesBadge extends AbstractBadge
{
    /**
     * The routes to access this badge.
     *
     * @var array<int, string>
     */
    protected array $routes = [
        '/bitbucket/open-issues/{user}/{repo}',
    ];

    /**
     * The keywords that describe this badge.
     *
     * @var array<int, string>
     */
    protected array $keywords = [
        Category::ACTIVITY,
    ];

    public function handle(string $user, string $repo): array
    {
        return [
            'count' => $this->client->issues($user, $repo),
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('open issues', $properties['count']);
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/bitbucket/open-issues/atlassian/adf-builder-javascript' => 'open issues',
        ];
    }
}
