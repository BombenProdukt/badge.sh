<?php

declare(strict_types=1);

namespace App\Badges\RunKit\Badges;

use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class NotebookBadge extends AbstractBadge
{
    protected array $routes = [
        '/runkit/{owner}/{notebook}/{path?}',
    ];

    protected array $keywords = [
        Category::OTHER,
    ];

    public function handle(string $owner, string $notebook, ?string $path = null): array
    {
        return $this->client->get($owner, $notebook, $path);
    }

    public function render(array $properties): array
    {
        return [
            'label' => $properties['label'],
            'message' => $properties['message'],
            'messageColor' => $properties['messageColor'],
        ];
    }

    public function routeConstraints(Route $route): void
    {
        $route->where('path', RoutePattern::CATCH_ALL->value);
    }

    public function previews(): array
    {
        return [
            '/runkit/vladimyr/metaweather/44418/state' => 'metaweather (state)',
            '/runkit/vladimyr/metaweather/44418/temperature' => 'metaweather (temperature in °C)',
            '/runkit/vladimyr/metaweather/44418/temperature/f' => 'metaweather (temperature in °F)',
            '/runkit/vladimyr/metaweather/44418/wind' => 'metaweather (wind in km/h)',
            '/runkit/vladimyr/metaweather/44418/wind/mph' => 'metaweather (wind in mph)',
            '/runkit/vladimyr/metaweather/44418/humidity' => 'metaweather (humidity)',
        ];
    }
}
