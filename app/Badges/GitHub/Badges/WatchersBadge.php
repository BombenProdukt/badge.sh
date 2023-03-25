<?php

declare(strict_types=1);

namespace App\Badges\GitHub\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;
use PreemStudio\Formatter\FormatNumber;

final class WatchersBadge extends AbstractBadge
{
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

    public function keywords(): array
    {
        return [Category::SOCIAL];
    }

    public function routePaths(): array
    {
        return [
            '/github/watchers/{owner}/{repo}',
        ];
    }

    public function routeParameters(): array
    {
        return [];
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
