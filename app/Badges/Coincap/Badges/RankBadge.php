<?php

declare(strict_types=1);

namespace App\Badges\Coincap\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class RankBadge extends AbstractBadge
{
    /**
     * The routes to access this badge.
     *
     * @var array<int, string>
     */
    protected array $routes = [
        '/coincap/rank/{assetId}',
    ];

    /**
     * The keywords that describe this badge.
     *
     * @var array<int, string>
     */
    protected array $keywords = [
        Category::CRYPTO_CURRENCY,
    ];

    public function handle(string $assetId): array
    {
        return $this->client->get($assetId);
    }

    public function render(array $properties): array
    {
        return $this->renderNumber($properties['name'], $properties['rank']);
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
