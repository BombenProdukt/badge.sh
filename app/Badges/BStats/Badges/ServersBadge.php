<?php

declare(strict_types=1);

namespace App\Badges\BStats\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class ServersBadge extends AbstractBadge
{
    /**
     * The routes to access this badge.
     *
     * @var array<int, string>
     */
    protected array $routes = [
        '/bstats/servers/{projectId}',
    ];

    /**
     * The keywords that describe this badge.
     *
     * @var array<int, string>
     */
    protected array $keywords = [
        Category::METRICS,
    ];

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
