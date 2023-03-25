<?php

declare(strict_types=1);

namespace App\Badges\VaadinAddOnDirectory\Badges;

use App\Enums\Category;

final class StatusBadge extends AbstractBadge
{
    protected array $routes = [
        '/vaadin/status/{packageName}',
    ];

    protected array $keywords = [
        Category::OTHER,
    ];

    public function handle(string $packageName): array
    {
        return $this->client->get($packageName);
    }

    public function render(array $properties): array
    {
        return $this->renderText('status', $properties['status']);
    }

    public function previews(): array
    {
        return [
            '/vaadin/status/vaadinvaadin-grid' => 'status',
        ];
    }
}
