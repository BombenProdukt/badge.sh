<?php

declare(strict_types=1);

namespace App\Badges\NodePing\Badges;

use App\Enums\Category;

final class StatusBadge extends AbstractBadge
{
    protected array $routes = [
        '/nodeping/status/{uuid}',
    ];

    protected array $keywords = [
        Category::MONITORING,
    ];

    public function handle(string $uuid): array
    {
        return [
            'status' => $this->client->status($uuid) ? 'online' : 'offline',
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderText('status', $properties['status'], $properties['status'] === 'online' ? 'green.600' : 'red.600');
    }

    public function previews(): array
    {
        return [
            '/nodeping/status/jkiwn052-ntpp-4lbb-8d45-ihew6d9ucoei' => 'status',
        ];
    }
}
