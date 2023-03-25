<?php

declare(strict_types=1);

namespace App\Badges\Coverity\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class StatusBadge extends AbstractBadge
{
    protected array $routes = [
        '/coverity/status/{projectId}',
    ];

    protected array $keywords = [
        Category::ANALYSIS,
    ];

    public function handle(string $projectId): array
    {
        return [
            'status' => $this->client->status($projectId),
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderStatus($this->service(), $properties['status']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'status',
                path: '/coverity/status/3997',
                data: $this->render([]),
            ),
        ];
    }
}
