<?php

declare(strict_types=1);

namespace App\Badges\Keybase\Badges;

use App\Badges\Keybase\Client;
use App\Contracts\Badge;
use Illuminate\Routing\Route;

final class BTCBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $address): array
    {
        $response = $this->client->get($address, 'cryptocurrency_addresses');

        return [
            'label'        => 'BTC',
            'message'      => $response['them']['cryptocurrency_addresses']['bitcoin'][0]['address'],
            'messageColor' => 'blue.600',
        ];
    }

    public function service(): string
    {
        return 'Keybase';
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
            '/keybase/{address}/btc',
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
        //
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
            '/keybase/skyplabs/btc' => 'btc address',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
