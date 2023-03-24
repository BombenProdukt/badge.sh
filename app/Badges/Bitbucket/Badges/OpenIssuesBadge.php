<?php

declare(strict_types=1);

namespace App\Badges\Bitbucket\Badges;

use App\Enums\Category;

final class OpenIssuesBadge extends AbstractBadge
{
    public function handle(string $user, string $repo): array
    {
        return $this->renderNumber('open issues', $this->client->issues($user, $repo));
    }

    public function keywords(): array
    {
        return [Category::ACTIVITY];
    }

    public function routePaths(): array
    {
        return [
            '/bitbucket/open-issues/{user}/{repo}',
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
            '/bitbucket/open-issues/atlassian/adf-builder-javascript' => 'open issues',
        ];
    }
}
