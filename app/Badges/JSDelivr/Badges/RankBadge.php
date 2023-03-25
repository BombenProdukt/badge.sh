<?php

declare(strict_types=1);

namespace App\Badges\JSDelivr\Badges;

use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class RankBadge extends AbstractBadge
{
    public function handle(string $platform, string $package): array
    {
        return $this->client->data($platform, $package);
    }

    public function render(array $properties): array
    {
        return [
            'label' => 'jsDelivr rank',
            'message' => $properties['rank'] ? '#'.$properties['rank'] : 'none',
            'messageColor' => $properties['rank'] ? 'blue.600' : 'gray.600',
        ];
    }

    public function keywords(): array
    {
        return [Category::SOCIAL];
    }

    public function routePaths(): array
    {
        return [
            '/jsdelivr/rank/{platform}/{package}',
        ];
    }

    public function routeParameters(): array
    {
        return [];
    }

    public function routeConstraints(Route $route): void
    {
        $route->where('package', RoutePattern::CATCH_ALL->value);
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/jsdelivr/rank/npm/lodash' => 'rank',
        ];
    }
}
