<?php

declare(strict_types=1);

namespace App\Badges\GitHub\Badges;

use App\Enums\Category;

final class BranchesBadge extends AbstractBadge
{
    protected array $routes = [
        '/github/branches/{owner}/{repo}',
    ];

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
            '/github/branches/micromatch/micromatch' => 'branches',
        ];
    }
}
