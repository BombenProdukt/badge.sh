<?php

declare(strict_types=1);

namespace App\Badges\NPM\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class NodeBadge extends AbstractBadge
{
    protected array $routes = [
        '/npm/node-version/{package}/{tag?}',
    ];

    protected array $keywords = [
        Category::PLATFORM_SUPPORT,
    ];

    public function handle(string $package, string $tag = 'latest'): array
    {
        return [
            'version' => $this->client->unpkg("{$package}@{$tag}/package.json")['engines']['node'],
        ];
    }

    public function render(array $properties): array
    {
        return [
            'label' => 'node',
            'message' => $properties['version'],
            'messageColor' => 'green.600',
        ];
    }

    public function routeConstraints(Route $route): void
    {
        $route->where('package', RoutePattern::PACKAGE_WITH_SCOPE->value);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'node version',
                path: '/npm/node-version/next',
                data: $this->render([]),
            ),
        ];
    }
}
