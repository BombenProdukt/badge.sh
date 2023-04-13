<?php

declare(strict_types=1);

namespace App\Badges\Bitbucket;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class OpenPullRequestsBadge extends AbstractBadge
{
    protected string $route = '/bitbucket/open-pull-requests/{user}/{repo}';

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

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'open pull requests',
                path: '/bitbucket/open-pull-requests/atlassian/adf-builder-javascript',
                data: $this->render(['count' => 0]),
            ),
        ];
    }
}
