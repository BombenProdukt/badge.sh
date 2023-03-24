<?php

declare(strict_types=1);

namespace App\Badges\NPM\Badges;

use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class NodeBadge extends AbstractBadge
{
    public function handle(string $package, string $tag = 'latest'): array
    {
        return [
            'version' => $this->client->unpkg("{$package}@{$tag}/package.json")['engines']['node'],
        ];
    }

    public function render(array $properties): array
    {
        return [
            'label'        => 'node',
            'message'      => $properties['version'],
            'messageColor' => 'green.600',
        ];
    }

    public function keywords(): array
    {
        return [Category::PLATFORM_SUPPORT];
    }

    public function routePaths(): array
    {
        return [
            '/npm/node-version/{package}/{tag?}',
        ];
    }

    public function routeParameters(): array
    {
        return [];
    }

    public function routeConstraints(Route $route): void
    {
        $route->where('package', RoutePattern::PACKAGE_WITH_SCOPE->value);
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/npm/node-version/next' => 'node version',
        ];
    }
}
