<?php

declare(strict_types=1);

namespace App\Badges\Keybase\Badges;

use App\Enums\Category;

final class BTCBadge extends AbstractBadge
{
    protected array $routes = [
        '/keybase/btc/{address}',
    ];

    protected array $keywords = [
        Category::SOCIAL,
    ];

    public function handle(string $address): array
    {
        return $this->client->get($address, 'cryptocurrency_addresses.them.cryptocurrency_addresses.bitcoin.0');
    }

    public function render(array $properties): array
    {
        return [
            'label' => 'BTC',
            'message' => $properties['address'],
            'messageColor' => 'blue.600',
        ];
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
