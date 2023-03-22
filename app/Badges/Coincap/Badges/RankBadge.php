<?php

declare(strict_types=1);

namespace App\Badges\Coincap\Badges;

use App\Badges\AbstractBadge;
use App\Badges\Coincap\Client;
use App\Enums\Category;
use Illuminate\Routing\Route;

final class RankBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $assetId): array
    {
        $response = $this->client->get($assetId);

        return $this->renderNumber($response['name'], $response['rank']);
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
            '/coincap/rank/{assetId}',
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
            '/coincap/rank/bitcoin' => 'price',
        ];
    }
}
