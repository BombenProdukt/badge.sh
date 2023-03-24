<?php

declare(strict_types=1);

namespace App\Badges\Jenkins\Badges;

use App\Badges\AbstractBadge;
use App\Badges\Jenkins\Client;
use App\Enums\Category;
use App\Enums\RoutePattern;
use Http;
use Illuminate\Routing\Route;

final class PluginPopularityBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $plugin): array
    {
        $response = Http::get('https://updates.jenkins-ci.org/current/update-center.actual.json')->throw()->json('plugins');

        return $this->renderNumber('popularity', $response[$plugin]['popularity']);
    }

    public function service(): string
    {
        return 'Jenkins';
    }

    public function keywords(): array
    {
        return [Category::SOCIAL];
    }

    public function routePaths(): array
    {
        return [
            '/jenkins/plugin-popularity/{plugin}',
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
            '/jenkins/plugin-popularity/blueocean' => 'plugin popularity',
        ];
    }
}
