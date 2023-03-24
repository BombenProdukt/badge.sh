<?php

declare(strict_types=1);

namespace App\Badges\Ore\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class CategoryBadge extends AbstractBadge
{
    public function handle(string $pluginId): array
    {
        return $this->client->get($pluginId)['category'];
    }

    public function render(array $properties): array
    {
        return $this->renderText('category', $properties['title']);
    }

    public function keywords(): array
    {
        return [Category::VERSION];
    }

    public function routePaths(): array
    {
        return [
            '/ore/category/{pluginId}',
        ];
    }

    public function routeParameters(): array
    {
        return [];
    }

    public function routeConstraints(Route $route): void
    {
        //
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/ore/category/nucleus' => 'category',
        ];
    }
}
