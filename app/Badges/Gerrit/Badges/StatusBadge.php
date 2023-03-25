<?php

declare(strict_types=1);

namespace App\Badges\Gerrit\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class StatusBadge extends AbstractBadge
{
    protected array $routes = [
        '/gerrit/status/{changeId}',
    ];

    protected array $keywords = [
        Category::LICENSE,
    ];

    public function handle(string $changeId): array
    {
        return $this->client->get($changeId);
    }

    public function render(array $properties): array
    {
        return $this->renderStatus('status', $properties['status']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'status',
                path: '/gerrit/status/1011478',
                data: $this->render([]),
            ),
        ];
    }
}
