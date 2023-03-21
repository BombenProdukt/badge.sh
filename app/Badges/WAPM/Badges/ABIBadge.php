<?php

declare(strict_types=1);

namespace App\Badges\WAPM\Badges;

use App\Badges\AbstractBadge;
use App\Badges\WAPM\Client;
use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class ABIBadge extends AbstractBadge
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
        return 'WebAssembly Package Manager';
    }

    public function title(): string
    {
        return 'ABI';
    }

    public function keywords(): array
    {
        return [Category::PLATFORM_SUPPORT];
    }

    public function routePaths(): array
    {
        return [
            '/wapm/abi/{package}',
        ];
    }

    public function routeParameters(): array
    {
        return [];
    }

    public function routeConstraints(Route $route): void
    {
        $route->where('package', RoutePattern::CATCH_ALL->value);
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/wapm/abi/jwmerrill/lox-repl' => 'abi',
            '/wapm/abi/kherrick/pwgen'     => 'abi',
        ];
    }
}
