<?php

declare(strict_types=1);

namespace App\Badges\Shardbox\Badges;

use App\Badges\Shardbox\Client;
use App\Contracts\Badge;
use Illuminate\Routing\Route;

final class CrystalBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $shard): array
    {
        preg_match('/Crystal<\\/span>\\s*<span[^>]*?>([^<]+)<\\//i', $this->client->get($shard), $matches);

        return [
            'label'       => 'crystal',
            'status'      => html_entity_decode($matches[1]),
            'statusColor' => 'green.600',
        ];
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
            '/shards/{shard}/version/crystal',
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
            '/shards/amber/version/crystal' => 'crystal version',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
