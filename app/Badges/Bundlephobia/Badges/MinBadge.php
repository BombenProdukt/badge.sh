<?php

declare(strict_types=1);

namespace App\Badges\Bundlephobia\Badges;

use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class MinBadge extends AbstractBadge
{
    protected array $routes = [
        '/bundlephobia/min/{name}',
    ];

    protected array $keywords = [
        Category::SIZE,
    ];

    public function handle(string $name): array
    {
        return $this->client->get($name);
    }

    public function render(array $properties): array
    {
        return $this->renderSize($properties['size'], 'minified size');
    }

    public function routeConstraints(Route $route): void
    {
        $route->where('name', RoutePattern::CATCH_ALL->value);
    }

    public function previews(): array
    {
        return [
            '/bundlephobia/min/react' => 'minified',
        ];
    }
}
