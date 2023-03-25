<?php

declare(strict_types=1);

namespace App\Badges\Jenkins\Badges;

use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Http;

final class PluginSizeBadge extends AbstractBadge
{
    /**
     * The routes to access this badge.
     *
     * @var array<int, string>
     */
    protected array $routes = [
        '/jenkins/plugin-size/{plugin}',
    ];

    /**
     * The keywords that describe this badge.
     *
     * @var array<int, string>
     */
    protected array $keywords = [
        Category::SIZE,
    ];

    public function handle(string $plugin): array
    {
        return Http::get('https://updates.jenkins-ci.org/current/update-center.actual.json')->throw()->json('plugins')[$plugin];
    }

    public function render(array $properties): array
    {
        return $this->renderSize($properties['size']);
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
