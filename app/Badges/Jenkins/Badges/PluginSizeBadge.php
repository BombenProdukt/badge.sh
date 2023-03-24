<?php

declare(strict_types=1);

namespace App\Badges\Jenkins\Badges;

use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Http;

final class PluginSizeBadge extends AbstractBadge
{
    public function handle(string $plugin): array
    {
        $response = Http::get('https://updates.jenkins-ci.org/current/update-center.actual.json')->throw()->json('plugins');

        return $this->renderSize($response[$plugin]['size']);
    }

    public function keywords(): array
    {
        return [Category::SIZE];
    }

    public function routePaths(): array
    {
        return [
            '/jenkins/plugin-size/{plugin}',
        ];
    }

    public function routeParameters(): array
    {
        return [];
    }

    public function routeConstraints(Route $route): void
    {
        $route->where('job', RoutePattern::CATCH_ALL->value);
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/jenkins/plugin-size/blueocean' => 'plugin size',
        ];
    }
}
