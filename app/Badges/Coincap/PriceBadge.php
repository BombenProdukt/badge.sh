<?php

declare(strict_types=1);

namespace App\Badges\Coincap;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class PriceBadge extends AbstractBadge
{
    protected string $route = '/coincap/price/{assetId}';

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

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'price',
                path: '/coincap/price/bitcoin',
                data: $this->render(['ticker' => 'bitcoin', 'price' => 0]),
            ),
        ];
    }
}
