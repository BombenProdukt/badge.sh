<?php

declare(strict_types=1);

namespace App\Badges\Ore\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class StarsBadge extends AbstractBadge
{
    public function handle(string $pluginId): array
    {
        return $this->client->get($pluginId)['stats'];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('stars', $properties['stars']);
    }

    public function keywords(): array
    {
        return [Category::SOCIAL];
    }

    public function routePaths(): array
    {
        return [
            '/ore/stars/{pluginId}',
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
            '/ore/stars/nucleus' => 'stars',
        ];
    }
}
