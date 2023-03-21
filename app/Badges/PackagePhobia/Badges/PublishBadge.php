<?php

declare(strict_types=1);

namespace App\Badges\PackagePhobia\Badges;

use App\Badges\PackagePhobia\Client;
use App\Contracts\Badge;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class PublishBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $name): array
    {
        $response = $this->client->get($name);

        return [
            'label'        => 'publish size',
            'message'      => $response['publish']['pretty'],
            'messageColor' => str_replace('#', '', $response['publish']['color']),
        ];
    }

    public function service(): string
    {
        return 'Package Phobia';
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
            '/packagephobia/publish/{name}',
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
            '/packagephobia/publish/webpack'               => 'publish size',
            '/packagephobia/publish/@tusbar/cache-control' => '(scoped pkg) publish size',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
