<?php

declare(strict_types=1);

namespace App\Badges\RunKit\Badges;

use App\Badges\RunKit\Client;
use App\Contracts\Badge;
use Illuminate\Routing\Route;

final class NotebookBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $owner, string $notebook, string $path): array
    {
        $response = $this->client->get($owner, $notebook, $path);

        return [
            'label'       => $response['label'],
            'status'      => $response['status'],
            'statusColor' => $response['statusColor'],
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
        return [
            //
        ];
    }

    public function routePaths(): array
    {
        return [
            '/runkit/{owner}/{notebook}/{path}',
        ];
    }

    public function routeParameters(): array
    {
        return [
            //
        ];
    }

    public function routeConstraints(Route $route): void
    {
        $route->where('path', '.+');
    }

    public function staticPreviews(): array
    {
        return [
            //
        ];
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

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
