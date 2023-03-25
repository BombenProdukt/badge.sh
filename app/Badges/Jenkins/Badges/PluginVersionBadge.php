<?php

declare(strict_types=1);

namespace App\Badges\Jenkins\Badges;

use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Http;

final class PluginVersionBadge extends AbstractBadge
{
    protected array $routes = [
        '/jenkins/plugin-version/{plugin}',
    ];

    protected array $keywords = [
        Category::VERSION,
    ];

    public function handle(string $plugin): array
    {
        return Http::get('https://updates.jenkins-ci.org/current/update-center.actual.json')->throw()->json('plugins')[$plugin];
    }

    public function render(array $properties): array
    {
        return $this->renderVersion($properties['version']);
    }

    public function routeConstraints(Route $route): void
    {
        $route->where('job', RoutePattern::CATCH_ALL->value);
    }

    public function previews(): array
    {
        return [
            '/jenkins/plugin-version/blueocean' => 'plugin version',
        ];
    }
}
