<?php

declare(strict_types=1);

namespace App\Badges\Coincap\Badges;

use App\Enums\Category;

final class PriceBadge extends AbstractBadge
{
    protected array $routes = [
        '/coincap/price/{assetId}',
    ];

    protected array $keywords = [
        Category::CRYPTO_CURRENCY,
    ];

    public function handle(string $assetId): array
    {
        $response = $this->client->get($assetId);

        return [
            'ticker' => $response['name'],
            'price' => $response['priceUsd'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderMoney($properties['ticker'], $properties['price'], 'USD');
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/coincap/price/bitcoin' => 'price',
        ];
    }
}
