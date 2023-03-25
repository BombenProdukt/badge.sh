<?php

declare(strict_types=1);

namespace App\Badges\BStats\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class PlayersBadge extends AbstractBadge
{
    /**
     * The routes to access this badge.
     *
     * @var array<int, string>
     */
    protected array $routes = [
        '/bstats/players/{projectId}',
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
            'count' => $this->client->players($projectId),
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('players', $properties['count']);
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
            '/bstats/players/74299' => 'players',
        ];
    }
}
