<?php

declare(strict_types=1);

namespace App\Badges\BStats\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class ServersBadge extends AbstractBadge
{
    protected array $routes = [
        '/bstats/servers/{projectId}',
    ];

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

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'servers',
                path: '/bstats/servers/57479',
                data: $this->render(['count' => 0]),
            ),
        ];
    }
}
