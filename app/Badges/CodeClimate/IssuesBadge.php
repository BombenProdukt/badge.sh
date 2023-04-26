<?php

declare(strict_types=1);

namespace App\Badges\CodeClimate;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class IssuesBadge extends AbstractBadge
{
    protected string $route = '/codeclimate/issues/{user}/{repo}';

    protected array $keywords = [
        Category::ANALYSIS,
    ];

    public function handle(string $user, string $repo): array
    {
        return [
            'count' => $this->client->get($user, $repo, 'snapshots')['meta']['issues_count'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('issues', $properties['count']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'issues',
                path: '/codeclimate/issues/codeclimate/codeclimate',
                data: $this->render(['count' => 0]),
            ),
        ];
    }
}
