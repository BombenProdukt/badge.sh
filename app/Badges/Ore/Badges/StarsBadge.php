<?php

declare(strict_types=1);

namespace App\Badges\Ore\Badges;

use App\Enums\Category;

final class StarsBadge extends AbstractBadge
{
    protected array $routes = [
        '/ore/stars/{pluginId}',
    ];

    protected array $keywords = [
        Category::SOCIAL,
    ];

    public function handle(string $pluginId): array
    {
        return $this->client->get($pluginId)['stats'];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('stars', $properties['stars']);
    }

    public function previews(): array
    {
        return [
            '/ore/stars/nucleus' => 'stars',
        ];
    }
}
