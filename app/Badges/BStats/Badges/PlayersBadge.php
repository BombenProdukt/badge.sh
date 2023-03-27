<?php

declare(strict_types=1);

namespace App\Badges\BStats\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class PlayersBadge extends AbstractBadge
{
    protected string $route = '/bstats/players/{projectId}';

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

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'players',
                path: '/bstats/players/74299',
                data: $this->render(['count' => 0]),
            ),
        ];
    }
}
