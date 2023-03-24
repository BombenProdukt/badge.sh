<?php

declare(strict_types=1);

namespace App\Badges\Keybase\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class BTCBadge extends AbstractBadge
{
    public function handle(string $address): array
    {
        return $this->client->get($address, 'cryptocurrency_addresses.them.cryptocurrency_addresses.bitcoin.0');
    }

    public function render(array $properties): array
    {
        return [
            'label'        => 'BTC',
            'message'      => $properties['address'],
            'messageColor' => 'blue.600',
        ];
    }

    public function keywords(): array
    {
        return [Category::SOCIAL];
    }

    public function routePaths(): array
    {
        return [
            '/keybase/btc/{address}',
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
            '/keybase/btc/skyplabs' => 'btc address',
        ];
    }
}
