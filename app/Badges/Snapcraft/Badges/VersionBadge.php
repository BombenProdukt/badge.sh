<?php

declare(strict_types=1);

namespace App\Badges\Snapcraft\Badges;

use App\Badges\AbstractBadge;
use App\Badges\Snapcraft\Client;
use Illuminate\Routing\Route;
use Illuminate\Support\Arr;

final class VersionBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $snap, ?string $architecture = null, ?string $channel = null): array
    {
        $channels = collect($this->client->get($snap, ['version'])['channel-map']);

        $channel = match (true) {
            $architecture && $channel => $channels->firstWhere(fn (array $item) => Arr::get($item, 'channel.architecture') === $architecture && Arr::get($item, 'channel.name') === $channel),
            $architecture             => $channels->firstWhere(fn (array $item) => Arr::get($item, 'channel.architecture') === $architecture),
            default                   => $channels->first(),
        };

        return $this->renderVersion($this->service(), $channel['version']);
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
        return [];
    }

    public function routePaths(): array
    {
        return [
            '/snapcraft/version/{snap}/{architecture?}/{channel?}',
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
            '/snapcraft/version/joplin-desktop'              => 'version',
            '/snapcraft/version/mattermost-desktop/i386'     => 'version',
            '/snapcraft/version/telegram-desktop/arm64/edge' => 'version',
        ];
    }
}
