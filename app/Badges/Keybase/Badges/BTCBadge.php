<?php

declare(strict_types=1);

namespace App\Badges\Keybase\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class BTCBadge extends AbstractBadge
{
    protected string $route = '/keybase/btc/{address}';

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

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'btc address',
                path: '/keybase/btc/skyplabs',
                data: $this->render(['address' => '1A1zP1eP5QGefi2DMPTfTL5SLmv7DivfNa']),
            ),
        ];
    }
}
