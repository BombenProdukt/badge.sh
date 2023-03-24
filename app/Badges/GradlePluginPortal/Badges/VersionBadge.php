<?php

declare(strict_types=1);

namespace App\Badges\GradlePluginPortal\Badges;

use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class VersionBadge extends AbstractBadge
{
    public function handle(string $pluginId): array
    {
        $response = $this->client->get($pluginId);

        return $this->renderVersion($response->filterXPath('//version')->text());
    }

    public function keywords(): array
    {
        return [Category::VERSION];
    }

    public function routePaths(): array
    {
        return [
            '/gradle-plugin-portal/version/{pluginId}',
        ];
    }

    public function routeParameters(): array
    {
        return [];
    }

    public function routeConstraints(Route $route): void
    {
        $route->where('pathname', RoutePattern::CATCH_ALL->value);
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/gradle-plugin-portal/version/com.gradle.plugin-publish' => 'version',
        ];
    }
}
