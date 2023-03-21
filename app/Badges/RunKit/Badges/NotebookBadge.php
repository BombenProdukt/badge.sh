<?php

declare(strict_types=1);

namespace App\Badges\RunKit\Badges;

use App\Badges\AbstractBadge;
use App\Badges\RunKit\Client;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class NotebookBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $owner, string $notebook, ?string $path = null): array
    {
        $response = $this->client->get($owner, $notebook, $path);

        return [
            'label'        => $response['label'],
            'message'      => $response['status'],
            'messageColor' => $response['statusColor'],
        ];
    }

    public function service(): string
    {
        return 'RunKit';
    }

    public function title(): string
    {
        return '';
    }

    public function keywords(): array
    {
        return [];
    }

    public function routePaths(): array
    {
        return [
            '/runkit/{owner}/{notebook}/{path?}',
        ];
    }

    public function routeParameters(): array
    {
        return [];
    }

    public function routeConstraints(Route $route): void
    {
        $route->where('path', RoutePattern::CATCH_ALL->value);
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/runkit/vladimyr/metaweather/44418/state'         => 'metaweather (state)',
            '/runkit/vladimyr/metaweather/44418/temperature'   => 'metaweather (temperature in °C)',
            '/runkit/vladimyr/metaweather/44418/temperature/f' => 'metaweather (temperature in °F)',
            '/runkit/vladimyr/metaweather/44418/wind'          => 'metaweather (wind in km/h)',
            '/runkit/vladimyr/metaweather/44418/wind/mph'      => 'metaweather (wind in mph)',
            '/runkit/vladimyr/metaweather/44418/humidity'      => 'metaweather (humidity)',
        ];
    }
}
