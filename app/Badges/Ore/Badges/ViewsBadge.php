<?php

declare(strict_types=1);

namespace App\Badges\Ore\Badges;

use App\Enums\Category;

final class ViewsBadge extends AbstractBadge
{
    protected array $routes = [
        '/ore/views/{pluginId}',
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
        return $this->renderNumber('views', $properties['views']);
    }

    public function previews(): array
    {
        return [
            '/ore/views/nucleus' => 'views',
        ];
    }
}
