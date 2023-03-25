<?php

declare(strict_types=1);

namespace App\Badges\GitHub\Badges;

use App\Enums\Category;

final class TagsBadge extends AbstractBadge
{
    protected array $routes = [
        '/github/tags/{owner}/{repo}',
    ];

    protected array $keywords = [
        Category::VERSION,
    ];

    public function handle(string $owner, string $repo): array
    {
        $result = $this->client->makeRepoQuery($owner, $repo, 'refs(first: 0, refPrefix: "refs/tags/") { totalCount }');

        return [
            'count' => $result['refs']['totalCount'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('tags', $properties['count']);
    }

    public function previews(): array
    {
        return [
            '/github/tags/micromatch/micromatch' => 'tags',
        ];
    }
}
