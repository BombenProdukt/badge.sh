<?php

declare(strict_types=1);

namespace App\Badges\JSDelivr\Badges;

use App\Badges\AbstractBadge;
use App\Badges\JSDelivr\Client;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class RankBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $platform, string $package): array
    {
        $rank = $this->client->data($platform, $package)['rank'];

        return [
            'label'        => 'jsDelivr rank',
            'message'      => $rank ? "#{$rank}" : 'none',
            'messageColor' => $rank ? 'blue.600' : 'gray.600',
        ];
    }

    public function service(): string
    {
        return 'jsDelivr';
    }

    public function title(): string
    {
        return '';
    }

    public function keywords(): array
    {
        return [];
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
