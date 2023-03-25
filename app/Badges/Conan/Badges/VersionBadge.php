<?php

declare(strict_types=1);

namespace App\Badges\Conan\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class VersionBadge extends AbstractBadge
{
    protected array $routes = [
        '/conan/version/{packageName}',
    ];

    protected array $keywords = [
        Category::VERSION,
    ];

    public function handle(string $packageName): array
    {
        return [
            'version' => \array_key_first($this->client->get($packageName)['versions']),
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderVersion($properties['version']);
    }

    public function routeConstraints(Route $route): void
    {
        $route->where('packageName', RoutePattern::CATCH_ALL->value);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'version',
                path: '/conan/version/boost',
                data: $this->render([]),
            ),
        ];
    }
}
