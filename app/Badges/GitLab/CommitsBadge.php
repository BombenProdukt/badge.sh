<?php

declare(strict_types=1);

namespace App\Badges\GitLab;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class CommitsBadge extends AbstractBadge
{
    protected string $route = '/gitlab/commits/{repo:wildcard}/{ref:wildcard?}';

    protected array $keywords = [
        Category::SOCIAL,
    ];

    public function handle(string $repo, ?string $ref = null): array
    {
        return [
            'count' => $this->client->rest($repo, $ref ? "repository/commits?ref={$ref}" : 'repository/commits')->header('x-total'),
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('commits', $properties['count']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'commits count',
                path: '/gitlab/commits/cryptsetup/cryptsetup',
                data: $this->render(['count' => '1000']),
            ),
            new BadgePreviewData(
                name: 'commits count (branch ref)',
                path: '/gitlab/commits/cryptsetup/cryptsetup/coverity_scan',
                data: $this->render(['count' => '1000']),
            ),
            new BadgePreviewData(
                name: 'commits count (tag ref)',
                path: '/gitlab/commits/cryptsetup/cryptsetup/v2.2.2',
                data: $this->render(['count' => '1000']),
            ),
        ];
    }
}
