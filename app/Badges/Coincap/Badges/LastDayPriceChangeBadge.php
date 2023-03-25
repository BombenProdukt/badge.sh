<?php

declare(strict_types=1);

namespace App\Badges\Coincap\Badges;

use App\Enums\Category;

final class LastDayPriceChangeBadge extends AbstractBadge
{
    protected array $routes = [
        '/coincap/last-day-price-change/{assetId}',
    ];

    protected array $keywords = [
        Category::CRYPTO_CURRENCY,
    ];

    public function handle(string $assetId): array
    {
        $response = $this->client->get($assetId);

        return [
            'ticker' => $response['name'],
            'percentage' => $response['changePercent24Hr'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderPercentage($properties['ticker'], $properties['percentage']);
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/coincap/last-day-price-change/bitcoin' => 'price',
        ];
    }
}
