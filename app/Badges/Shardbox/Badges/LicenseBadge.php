<?php

declare(strict_types=1);

namespace App\Badges\Shardbox\Badges;

use App\Badges\Shardbox\Client;
use App\Badges\Templates\LicenseTemplate;
use App\Contracts\Badge;
use Illuminate\Routing\Route;

final class LicenseBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $shard): array
    {
        preg_match('/opensource.org\\/licenses\\/[^>]+?>([^<]+)<\\//i', $this->client->get($shard), $matches);

        return LicenseTemplate::make($matches[1]);
    }

    public function service(): string
    {
        return 'Shardbox';
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
            '/shards/license/{shard}',
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
        //
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
            '/shards/license/clear' => 'license',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
