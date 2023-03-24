<?php

declare(strict_types=1);

namespace App\Badges\JetBrains\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class VersionBadge extends AbstractBadge
{
    public function handle(string $pluginId): array
    {
        if (is_numeric($pluginId)) {
            return $this->renderVersion($this->client->legacy($pluginId)->filterXPath('//plugin-repository//category//idea-plugin//version')->text());
        }

        return $this->renderVersion($this->client->updates($pluginId)[0]['version']);
    }

    public function keywords(): array
    {
        return [Category::VERSION];
    }

    public function routePaths(): array
    {
        return [
            '/jetbrains/version/{pluginId}',
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
            '/jetbrains/version/13441-laravel-idea' => 'version',
            '/jetbrains/version/9630'               => 'version (legacy plugin)',
        ];
    }
}
