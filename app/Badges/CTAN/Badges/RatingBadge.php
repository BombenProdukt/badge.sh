<?php

declare(strict_types=1);

namespace App\Badges\CTAN\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class RatingBadge extends AbstractBadge
{
    public function handle(string $package): array
    {
        preg_match('/<span>[^<]*?([\d.]+)\s/i', $this->client->web($package), $matches);

        return [
            'rating' => $matches[1],
        ];
    }

    public function render(array $properties): array
    {
        return [
            'label'        => 'rating',
            'message'      => number_format((float) $properties['rating'], 2).'/5',
            'messageColor' => 'green.600',
        ];
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
