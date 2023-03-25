<?php

declare(strict_types=1);

namespace App\Badges\Gitter\Badges;

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
            '/gitter/status/redom/lobby' => 'status',
            '/gitter/status/redom/redom' => 'status',
        ];
    }
}
