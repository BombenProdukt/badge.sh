<?php

declare(strict_types=1);

namespace App\Badges\WAPM\Badges;

use App\Badges\WAPM\Client;
use App\Contracts\Badge;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class ABIBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $package): array
    {
        $abis = collect($this->client->get($package)['modules'])->map->abi->sort()->implode(' | ');

        return [
            'label'        => 'abi',
            'message'      => $abis,
            'messageColor' => $abis ? 'blue.600' : 'green.600',
        ];
    }

    public function service(): string
    {
        return 'WAPM';
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
            '/wapm/{package}/abi',
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
        $route->where('package', RoutePattern::CATCH_ALL->value);
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
            '/wapm/jwmerrill/lox-repl/abi' => 'abi',
            '/wapm/kherrick/pwgen/abi'     => 'abi',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
