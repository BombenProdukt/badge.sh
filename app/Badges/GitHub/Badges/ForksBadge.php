<?php

declare(strict_types=1);

namespace App\Badges\GitHub\Badges;

use App\Enums\Category;

final class ForksBadge extends AbstractBadge
{
    protected array $routes = [
        '/github/forks/{owner}/{repo}',
    ];

    protected array $keywords = [
        Category::SOCIAL,
    ];

    public function handle(string $owner, string $repo): array
    {
        return [
            'count' => $this->client->makeRepoQuery($owner, $repo, 'forks { totalCount }')['forks']['totalCount'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('forks', $properties['count']);
    }

    public function previews(): array
    {
        return [
            '/github/forks/micromatch/micromatch' => 'forks',
        ];
    }
}
