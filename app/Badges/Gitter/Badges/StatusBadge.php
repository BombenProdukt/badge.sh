<?php

declare(strict_types=1);

namespace App\Badges\Gitter\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class StatusBadge extends AbstractBadge
{
    protected array $routes = [
        '/gitter/status/{org}/{room}',
    ];

    protected array $keywords = [
        Category::SOCIAL,
    ];

    public function handle(string $org, string $room): array
    {
        return [];
    }

    public function render(array $properties): array
    {
        return $this->renderText('gitter', 'on gitter', 'ed1965');
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'status',
                path: '/gitter/status/redom/lobby',
                data: $this->render(['status' => 'success']),
            ),
            new BadgePreviewData(
                name: 'status',
                path: '/gitter/status/redom/redom',
                data: $this->render(['status' => 'success']),
            ),
        ];
    }
}
