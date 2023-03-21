<?php

declare(strict_types=1);

namespace App\Badges\Bundlephobia\Badges;

use App\Badges\Bundlephobia\Client;
use App\Contracts\Badge;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class TreeShakingBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $name): array
    {
        $response        = $this->client->get($name);
        $isTreeShakeable = $response['hasJSModule'] || $response['hasJSNext'];

        return [
            'label'        => 'tree shaking',
            'message'      => $isTreeShakeable ? 'supported' : 'not supported',
            'messageColor' => $isTreeShakeable ? 'green.600' : 'red.600',
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
            '/bundlephobia/tree-shaking/{name}',
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
            '/bundlephobia/tree-shaking/react-colorful' => 'tree-shaking support',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
