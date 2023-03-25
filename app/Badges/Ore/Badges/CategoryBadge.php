<?php

declare(strict_types=1);

namespace App\Badges\Ore\Badges;

use App\Enums\Category;

final class CategoryBadge extends AbstractBadge
{
    protected array $routes = [
        '/ore/category/{pluginId}',
    ];

    protected array $keywords = [
        Category::VERSION,
    ];

    public function handle(string $pluginId): array
    {
        return $this->client->get($pluginId)['category'];
    }

    public function render(array $properties): array
    {
        return $this->renderText('category', $properties['title']);
    }

    public function previews(): array
    {
        return [
            '/ore/category/nucleus' => 'category',
        ];
    }
}
