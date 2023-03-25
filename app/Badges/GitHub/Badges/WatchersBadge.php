<?php

declare(strict_types=1);

namespace App\Badges\GitHub\Badges;

use App\Enums\Category;
use PreemStudio\Formatter\FormatNumber;

final class WatchersBadge extends AbstractBadge
{
    protected array $routes = [
        '/github/watchers/{owner}/{repo}',
    ];

    protected array $keywords = [
        Category::SOCIAL,
    ];

    public function handle(string $owner, string $repo): array
    {
        return [
            'watchers' => $this->client->makeRepoQuery($owner, $repo, 'watchers { totalCount }')['watchers']['totalCount'],
        ];
    }

    public function render(array $properties): array
    {
        return [
            'label' => 'watchers',
            'message' => FormatNumber::execute($properties['watchers']),
            'messageColor' => 'blue.600',
        ];
    }

    public function previews(): array
    {
        return [
            '/github/watchers/micromatch/micromatch' => 'watchers',
        ];
    }
}
