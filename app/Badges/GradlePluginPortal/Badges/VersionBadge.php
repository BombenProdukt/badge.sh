<?php

declare(strict_types=1);

namespace App\Badges\GradlePluginPortal\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class VersionBadge extends AbstractBadge
{
    protected array $routes = [
        '/gradle-plugin-portal/version/{pluginId}',
    ];

    protected array $keywords = [
        Category::VERSION,
    ];

    public function handle(string $pluginId): array
    {
        return [
            'version' => $this->client->get($pluginId)->filterXPath('//version')->text(),
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderVersion($properties['version']);
    }

    public function routeConstraints(Route $route): void
    {
        $route->where('pathname', RoutePattern::CATCH_ALL->value);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'version',
                path: '/gradle-plugin-portal/version/com.gradle.plugin-publish',
                data: $this->render([]),
            ),
        ];
    }
}
