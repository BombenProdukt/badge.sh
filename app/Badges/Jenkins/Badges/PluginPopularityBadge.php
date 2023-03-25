<?php

declare(strict_types=1);

namespace App\Badges\Jenkins\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Http;

final class PluginPopularityBadge extends AbstractBadge
{
    protected array $routes = [
        '/jenkins/plugin-popularity/{plugin}',
    ];

    protected array $keywords = [
        Category::SOCIAL,
    ];

    public function handle(string $plugin): array
    {
        return Http::get('https://updates.jenkins-ci.org/current/update-center.actual.json')->throw()->json('plugins')[$plugin];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('popularity', $properties['popularity']);
    }

    public function routeConstraints(Route $route): void
    {
        $route->where('job', RoutePattern::CATCH_ALL->value);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'plugin popularity',
                path: '/jenkins/plugin-popularity/blueocean',
                data: $this->render(['popularity' => 0]),
            ),
        ];
    }
}
