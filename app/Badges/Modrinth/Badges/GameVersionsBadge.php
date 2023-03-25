<?php

declare(strict_types=1);

namespace App\Badges\Modrinth\Badges;

use App\Enums\Category;

final class GameVersionsBadge extends AbstractBadge
{
    protected array $routes = [
        '/modrinth/game-versions/{projectId}',
    ];

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

    public function previews(): array
    {
        return [
            '/modrinth/game-versions/AANobbMI' => 'game versions',
        ];
    }
}
