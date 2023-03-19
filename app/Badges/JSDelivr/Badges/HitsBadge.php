<?php

declare(strict_types=1);

namespace App\Badges\JSDelivr\Badges;

use App\Badges\JSDelivr\Client;
use App\Contracts\Badge;
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
            'label'       => 'jsDelivr',
            'status'      => FormatNumber::execute($total).'/month',
            'statusColor' => 'green.600',
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
            '/jsdelivr/hits/{platform}/{package}',
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
        $route->where('package', '.+');
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
            '/jsdelivr/hits/gh/jquery/jquery' => 'hits (per month)',
            '/jsdelivr/hits/npm/lodash'       => 'hits (per month)',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
