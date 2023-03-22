<?php

declare(strict_types=1);

namespace App\Badges\Coincap\Badges;

use App\Badges\AbstractBadge;
use App\Badges\Coincap\Client;
use App\Enums\Category;
use Illuminate\Routing\Route;

final class LastDayPriceChangeBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $assetId): array
    {
        $response = $this->client->get($assetId);

        return $this->renderPercentage($response['name'], $response['changePercent24Hr']);
    }

    public function service(): string
    {
        return 'CoinCap';
    }

    public function keywords(): array
    {
        return [Category::CRYPTO_CURRENCY];
    }

    public function routePaths(): array
    {
        return [
            '/coincap/last-day-price-change/{assetId}',
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
            '/coincap/last-day-price-change/bitcoin' => 'price',
        ];
    }
}
