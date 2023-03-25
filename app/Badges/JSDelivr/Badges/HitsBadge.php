<?php

declare(strict_types=1);

namespace App\Badges\JSDelivr\Badges;

use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;
use PreemStudio\Formatter\FormatNumber;

final class HitsBadge extends AbstractBadge
{
    public function handle(string $platform, string $package): array
    {
        return [
            'count' => $this->client->data($platform, $package)['total'],
        ];
    }

    public function render(array $properties): array
    {
        return [
            'label' => 'jsDelivr',
            'message' => FormatNumber::execute($properties['count']).'/month',
            'messageColor' => 'green.600',
        ];
    }

    public function keywords(): array
    {
        return [Category::SOCIAL];
    }

    public function routePaths(): array
    {
        return [
            '/jsdelivr/hits/{platform}/{package}',
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
            '/jsdelivr/hits/gh/jquery/jquery' => 'hits (per month)',
            '/jsdelivr/hits/npm/lodash' => 'hits (per month)',
        ];
    }
}
