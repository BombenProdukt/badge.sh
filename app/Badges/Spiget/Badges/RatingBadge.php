<?php

declare(strict_types=1);

namespace App\Badges\Spiget\Badges;

use App\Badges\AbstractBadge;
use App\Badges\Spiget\Client;
use App\Enums\Category;
use Illuminate\Routing\Route;

final class RatingBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $resourceId): array
    {
        return $this->renderNumber('rating', $this->client->resource($resourceId)['rating']);
    }

    public function service(): string
    {
        return 'Spiget';
    }

    public function keywords(): array
    {
        return [Category::RATING];
    }

    public function routePaths(): array
    {
        return [
            '/spiget/rating/{resourceId}',
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
            '/spiget/rating/9089' => 'rating',
        ];
    }
}
