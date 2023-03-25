<?php

declare(strict_types=1);

namespace App\Badges\GitHub\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;
use PreemStudio\Formatter\FormatNumber;

final class WatchersBadge extends AbstractBadge
{
    /**
     * The routes to access this badge.
     *
     * @var array<int, string>
     */
    protected array $routes = [
        '/github/watchers/{owner}/{repo}',
    ];

    /**
     * The keywords that describe this badge.
     *
     * @var array<int, string>
     */
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

    public function routeConstraints(Route $route): void
    {
        //
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/github/watchers/micromatch/micromatch' => 'watchers',
        ];
    }
}
