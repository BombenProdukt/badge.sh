<?php

declare(strict_types=1);

namespace App\Badges\CTAN\Badges;

use App\Badges\AbstractBadge;
use App\Badges\CTAN\Client;
use App\Enums\Category;
use Illuminate\Routing\Route;

final class RatingBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $package): array
    {
        preg_match('/<span>[^<]*?([\d.]+)\s/i', $this->client->web($package), $matches);

        return [
            'label'        => 'rating',
            'message'      => number_format((float) $matches[1], 2).'/5',
            'messageColor' => 'green.600',
        ];
    }

    public function service(): string
    {
        return 'CTAN';
    }

    public function keywords(): array
    {
        return [Category::RATING];
    }

    public function routePaths(): array
    {
        return [
            '/ctan/rating/{package}',
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
            '/ctan/rating/pgf-pie' => 'rating',
        ];
    }
}
