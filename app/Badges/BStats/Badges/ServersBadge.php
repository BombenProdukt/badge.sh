<?php

declare(strict_types=1);

namespace App\Badges\BStats\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class ServersBadge extends AbstractBadge
{
    public function handle(string $projectId): array
    {
        return [
            'count' => $this->client->servers($projectId),
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('servers', $properties['count']);
    }

    public function keywords(): array
    {
        return [Category::METRICS];
    }

    public function routePaths(): array
    {
        return [
            '/bstats/servers/{projectId}',
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
            '/bstats/servers/57479' => 'servers',
        ];
    }
}
