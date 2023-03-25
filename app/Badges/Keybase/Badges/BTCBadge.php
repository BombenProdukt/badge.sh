<?php

declare(strict_types=1);

namespace App\Badges\Keybase\Badges;

use App\Data\BadgePreviewData;
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

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'btc address',
                path: '/keybase/btc/skyplabs',
                data: $this->render([]),
            ),
        ];
    }
}
