<?php

declare(strict_types=1);

namespace App\Badges\GitHub\Badges;

use App\Enums\Category;

final class ReleasesBadge extends AbstractBadge
{
    protected array $routes = [
        '/github/releases/{owner}/{repo}',
    ];

    protected array $keywords = [
        Category::VERSION,
    ];

    public function handle(string $owner, string $repo): array
    {
        return [
            'count' => $this->client->makeRepoQuery($owner, $repo, 'releases { totalCount }')['releases']['totalCount'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('releases', $properties['count']);
    }

    public function previews(): array
    {
        return [
            '/github/releases/micromatch/micromatch' => 'releases',
        ];
    }
}
