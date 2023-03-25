<?php

declare(strict_types=1);

namespace App\Badges\BStats\Badges;

use App\Enums\Category;

final class PlayersBadge extends AbstractBadge
{
    protected array $routes = [
        '/bstats/players/{projectId}',
    ];

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
