<?php

declare(strict_types=1);

namespace App\Badges\GitHub\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class BranchesBadge extends AbstractBadge
{
    protected string $route = '/github/branches/{owner}/{repo}';

    protected array $keywords = [
        Category::ACTIVITY,
    ];

    public function handle(string $owner, string $repo): array
    {
        return [
            'count' => $this->client->makeRepoQuery($owner, $repo, 'refs(first: 0, refPrefix: "refs/heads/") { totalCount }')['refs']['totalCount'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('branches', $properties['count']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'branches',
                path: '/github/branches/micromatch/micromatch',
                data: $this->render(['count' => '1000']),
            ),
        ];
    }
}
