<?php

declare(strict_types=1);

namespace App\Badges\Modrinth\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class GameVersionsBadge extends AbstractBadge
{
    /**
     * The routes to access this badge.
     *
     * @var array<int, string>
     */
    protected array $routes = [
        '/modrinth/game-versions/{projectId}',
    ];

    /**
     * The keywords that describe this badge.
     *
     * @var array<int, string>
     */
    protected array $keywords = [
        Category::VERSION,
    ];

    public function handle(string $projectId): array
    {
        return [
            'versions' => $this->client->version($projectId)['game_versions'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderVersion(\implode(' | ', $properties['versions']));
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
            '/modrinth/game-versions/AANobbMI' => 'game versions',
        ];
    }
}
