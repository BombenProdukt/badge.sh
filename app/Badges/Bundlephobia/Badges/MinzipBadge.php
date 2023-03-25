<?php

declare(strict_types=1);

namespace App\Badges\Bundlephobia\Badges;

use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class MinzipBadge extends AbstractBadge
{
    protected array $routes = [
        '/bundlephobia/minzip/{name}',
    ];

    protected array $keywords = [
        Category::SIZE,
    ];

    public function handle(string $name): array
    {
        return [
            'size' => $this->client->get($name)['gzip'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderSize($properties['size'], 'minzipped size');
    }

    public function routeConstraints(Route $route): void
    {
        $route->where('name', RoutePattern::CATCH_ALL->value);
    }

    public function previews(): array
    {
        return [
            '/bundlephobia/minzip/react' => 'minified + gzip',
            '/bundlephobia/minzip/@material-ui/core' => '(scoped pkg) minified + gzip',
        ];
    }
}
