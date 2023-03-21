<?php

declare(strict_types=1);

namespace App\Badges\Keybase\Badges;

use App\Badges\AbstractBadge;
use App\Badges\Keybase\Client;
use App\Enums\Category;
use Illuminate\Routing\Route;

final class ZECBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $address): array
    {
        $response = $this->client->get($address, 'cryptocurrency_addresses');

        return [
            'label'        => 'ZCash',
            'message'      => $response['them']['cryptocurrency_addresses']['zcash'][0]['address'],
            'messageColor' => 'blue.600',
        ];
    }

    public function service(): string
    {
        return 'Keybase';
    }

    public function title(): string
    {
        return 'Z-Cash Address';
    }

    public function keywords(): array
    {
        return [Category::SOCIAL];
    }

    public function routePaths(): array
    {
        return [
            '/keybase/zec/{address}',
        ];
    }

    public function routeParameters(): array
    {
        return [];
    }

    public function routeConstraints(Route $route): void
    {
        //
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/keybase/zec/skyplabs' => 'zec address',
        ];
    }
}
