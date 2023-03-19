<?php

declare(strict_types=1);

namespace App\Badges\JSDelivr\Badges;

use App\Badges\JSDelivr\Client;
use App\Contracts\Badge;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;
use PreemStudio\Formatter\FormatNumber;

final class HitsBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $platform, string $package): array
    {
        $total = $this->client->data($platform, $package)['total'];

        return [
            'label'        => 'jsDelivr',
            'message'      => FormatNumber::execute($total).'/month',
            'messageColor' => 'green.600',
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
        return [
            //
        ];
    }

    public function routePaths(): array
    {
        return [
            '/jsdelivr/{platform}/{package}/hits',
        ];
    }

    public function routeParameters(): array
    {
        return [
            //
        ];
    }

    public function routeConstraints(Route $route): void
    {
        $route->where('package', RoutePattern::CATCH_ALL->value);
    }

    public function staticPreviews(): array
    {
        return [
            //
        ];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/jsdelivr/gh/jquery/jquery/hits' => 'hits (per month)',
            '/jsdelivr/npm/lodash/hits'       => 'hits (per month)',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
