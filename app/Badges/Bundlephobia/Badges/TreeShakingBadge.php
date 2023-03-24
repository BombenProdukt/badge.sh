<?php

declare(strict_types=1);

namespace App\Badges\Bundlephobia\Badges;

use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class TreeShakingBadge extends AbstractBadge
{
    public function handle(string $name): array
    {
        $response = $this->client->get($name);

        return [
            'isTreeShakeable' => $response['hasJSModule'] || $response['hasJSNext'],
        ];
    }

    public function render(array $properties): array
    {
        return [
            'label'        => 'tree shaking',
            'message'      => $properties['isTreeShakeable'] ? 'supported' : 'not supported',
            'messageColor' => $properties['isTreeShakeable'] ? 'green.600' : 'red.600',
        ];
    }

    public function keywords(): array
    {
        return [Category::BUILD];
    }

    public function routePaths(): array
    {
        return [
            '/bundlephobia/tree-shaking/{name}',
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
            '/bundlephobia/tree-shaking/react-colorful' => 'tree-shaking support',
        ];
    }
}
