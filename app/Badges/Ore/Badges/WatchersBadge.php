<?php

declare(strict_types=1);

namespace App\Badges\Ore\Badges;

use App\Enums\Category;

final class WatchersBadge extends AbstractBadge
{
    protected array $routes = [
        '/ore/watchers/{pluginId}',
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
        return $this->renderNumber('watchers', $properties['watchers']);
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/ore/watchers/nucleus' => 'watchers',
        ];
    }
}
