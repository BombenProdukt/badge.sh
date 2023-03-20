<?php

declare(strict_types=1);

namespace App\Badges\PackagePhobia\Badges;

use App\Badges\PackagePhobia\Client;
use App\Contracts\Badge;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class InstallBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $name): array
    {
        $response = $this->client->get($name);

        return [
            'label'        => 'install size',
            'message'      => $response['install']['pretty'],
            'messageColor' => str_replace('#', '', $response['install']['color']),
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
            '/packagephobia/{name}/installation/size',
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
            '/packagephobia/webpack/installation/size'               => 'install size',
            '/packagephobia/@tusbar/cache-control/installation/size' => 'install size',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}