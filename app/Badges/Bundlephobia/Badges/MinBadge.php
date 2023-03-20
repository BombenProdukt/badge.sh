<?php

declare(strict_types=1);

namespace App\Badges\Bundlephobia\Badges;

use App\Badges\Bundlephobia\Client;
use App\Contracts\Badge;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;
use PreemStudio\Formatter\FormatBytes;

final class MinBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $name): array
    {
        return [
            'label'        => 'minified size',
            'message'      => FormatBytes::execute($this->client->get($name)['size']),
            'messageColor' => 'blue.600',
        ];
    }

    public function service(): string
    {
        return 'Bundlephobia';
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
            '/bundlephobia/{name}/min',
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
        $route->where('name', RoutePattern::CATCH_ALL->value);
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
            '/bundlephobia/react/min' => 'minified',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}