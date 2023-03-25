<?php

declare(strict_types=1);

namespace App\Badges\Keybase\Badges;

use App\Enums\Category;

final class ZECBadge extends AbstractBadge
{
    protected array $routes = [
        '/keybase/zec/{address}',
    ];

    protected array $keywords = [
        Category::SOCIAL,
    ];

    public function handle(string $address): array
    {
        return [
            'address' => $this->client->get($address, 'cryptocurrency_addresses'),
        ];
    }

    public function render(array $properties): array
    {
        return [
            'label' => 'ZCash',
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
            '/keybase/zec/skyplabs' => 'zec address',
        ];
    }
}
