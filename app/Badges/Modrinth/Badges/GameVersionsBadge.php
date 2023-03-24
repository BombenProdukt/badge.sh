<?php

declare(strict_types=1);

namespace App\Badges\Modrinth\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class GameVersionsBadge extends AbstractBadge
{
    public function handle(string $projectId): array
    {
        return $this->renderVersion(implode(' | ', $this->client->version($projectId)['game_versions']));
    }

    public function keywords(): array
    {
        return [Category::VERSION];
    }

    public function routePaths(): array
    {
        return [
            '/modrinth/game-versions/{projectId}',
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
            '/modrinth/game-versions/AANobbMI' => 'game versions',
        ];
    }
}
