<?php

declare(strict_types=1);

namespace App\Badges\Snapcraft\Badges;

use App\Badges\AbstractBadge;
use App\Badges\Snapcraft\Client;
use App\Enums\Category;
use Illuminate\Routing\Route;
use Illuminate\Support\Arr;
use PreemStudio\Formatter\FormatBytes;

final class SizeBadge extends AbstractBadge
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
            'message'      => FormatBytes::execute($channel['download']['size']),
            'messageColor' => 'green.600',
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
        return [Category::SIZE];
    }

    public function routePaths(): array
    {
        return [
            '/snapcraft/size/{snap}/{architecture?}/{channel?}',
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
            '/snapcraft/size/beekeeper-studio'            => 'distribution size',
            '/snapcraft/size/beekeeper-studio/arm64'      => 'distribution size',
            '/snapcraft/size/beekeeper-studio/armhf/edge' => 'distribution size',
        ];
    }
}
