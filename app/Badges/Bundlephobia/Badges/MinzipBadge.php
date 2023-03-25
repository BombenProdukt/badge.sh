<?php

declare(strict_types=1);

namespace App\Badges\Bundlephobia\Badges;

use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class MinzipBadge extends AbstractBadge
{
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

    public function keywords(): array
    {
        return [Category::SIZE];
    }

    public function routePaths(): array
    {
        return [
            '/bundlephobia/minzip/{name}',
        ];
    }

    public function routeParameters(): array
    {
        return [];
    }

    public function routeConstraints(Route $route): void
    {
        $route->where('name', RoutePattern::CATCH_ALL->value);
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/bundlephobia/minzip/react' => 'minified + gzip',
            '/bundlephobia/minzip/@material-ui/core' => '(scoped pkg) minified + gzip',
        ];
    }
}
