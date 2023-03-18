<?php

declare(strict_types=1);

namespace App\Badges\Shardbox\Badges;

use App\Actions\ExtractVersion;
use App\Actions\ExtractVersionColor;
use App\Badges\Shardbox\Client;
use App\Contracts\Badge;
use Illuminate\Routing\Route;

final class VersionBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $shard): array
    {
        preg_match('/class="version">([^<]+)<\\//i', $this->client->get($shard), $matches);

        return [
            'label'        => 'shards',
            'status'       => ExtractVersion::execute($matches[1]),
            'statusColor'  => ExtractVersionColor::execute($matches[1]),
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
            '/shards/v/{shard}',
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
            '/shards/v/kemal' => 'version',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
