<?php

declare(strict_types=1);

namespace App\Badges\RunKit\Badges;

use App\Data\BadgePreviewData;
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
            new BadgePreviewData(
                name: 'metaweather (state)',
                path: '/runkit/vladimyr/metaweather/44418/state',
                data: $this->render([]),
            ),
            new BadgePreviewData(
                name: 'metaweather (temperature in °C)',
                path: '/runkit/vladimyr/metaweather/44418/temperature',
                data: $this->render([]),
            ),
            new BadgePreviewData(
                name: 'metaweather (temperature in °F)',
                path: '/runkit/vladimyr/metaweather/44418/temperature/f',
                data: $this->render([]),
            ),
            new BadgePreviewData(
                name: 'metaweather (wind in km/h)',
                path: '/runkit/vladimyr/metaweather/44418/wind',
                data: $this->render([]),
            ),
            new BadgePreviewData(
                name: 'metaweather (wind in mph)',
                path: '/runkit/vladimyr/metaweather/44418/wind/mph',
                data: $this->render([]),
            ),
            new BadgePreviewData(
                name: 'metaweather (humidity)',
                path: '/runkit/vladimyr/metaweather/44418/humidity',
                data: $this->render([]),
            ),
        ];
    }
}
