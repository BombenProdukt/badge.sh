<?php

declare(strict_types=1);

namespace App\Badges\Bitbucket;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class OpenIssuesBadge extends AbstractBadge
{
    protected string $route = '/bitbucket/open-issues/{user}/{repo}';

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

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'open issues',
                path: '/bitbucket/open-issues/atlassian/adf-builder-javascript',
                data: $this->render(['count' => 0]),
            ),
        ];
    }
}
