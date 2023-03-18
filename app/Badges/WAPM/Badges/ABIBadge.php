<?php

declare(strict_types=1);

namespace App\Badges\WAPM\Badges;

use App\Badges\WAPM\Client;
use App\Contracts\Badge;
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
            'status'       => $abis,
            'statusColor'  => $abis ? 'blue.600' : 'green.600',
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
            '/wapm/abi/{package}',
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
        $route->where('package', '.+');
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
            '/wapm/abi/jwmerrill/lox-repl' => 'abi',
            '/wapm/abi/kherrick/pwgen'     => 'abi',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
