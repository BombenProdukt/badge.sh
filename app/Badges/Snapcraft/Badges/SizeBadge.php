<?php

declare(strict_types=1);

namespace App\Badges\Snapcraft\Badges;

use App\Badges\Snapcraft\Client;
use App\Contracts\Badge;
use Illuminate\Routing\Route;
use Illuminate\Support\Arr;
use PreemStudio\Formatter\FormatBytes;

final class SizeBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $snap, ?string $architecture = null, ?string $channel = null): array
    {
        $channels = collect($this->client->get($snap, ['size'])['channel-map']);

        $channel = match (true) {
            $architecture && $channel => $channels->firstWhere(fn (array $item) => Arr::get($item, 'channel.architecture') === $architecture && Arr::get($item, 'channel.name') === $channel),
            $architecture             => $channels->firstWhere(fn (array $item) => Arr::get($item, 'channel.architecture') === $architecture),
            default                   => $channels->first(),
        };

        return [
            'label'        => 'distrib size',
            'status'       => FormatBytes::execute($channel['download']['size']),
            'statusColor'  => 'green.600',
        ];
    }

    public function service(): string
    {
        return 'Snapcraft';
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
            '/snapcraft/{snap}/size/{architecture?}/{channel?}',
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
            '/snapcraft/beekeeper-studio/size'            => 'distribution size',
            '/snapcraft/beekeeper-studio/size/arm64'      => 'distribution size',
            '/snapcraft/beekeeper-studio/size/armhf/edge' => 'distribution size',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
