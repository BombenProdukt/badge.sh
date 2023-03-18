<?php

declare(strict_types=1);

namespace App\Badges\Snapcraft\Badges;

use App\Actions\ExtractVersion;
use App\Actions\ExtractVersionColor;
use App\Badges\Snapcraft\Client;
use App\Contracts\Badge;
use Illuminate\Routing\Route;
use Illuminate\Support\Arr;

final class VersionBadge implements Badge
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

        return [
            'label'        => 'snap',
            'status'       => ExtractVersion::execute($channel['version']),
            'statusColor'  => ExtractVersionColor::execute($channel['version']),
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
            '/snapcraft/v/{snap}/{architecture?}/{channel?}',
            '/snapcraft/version/{snap}/{architecture?}/{channel?}',
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
            '/snapcraft/v/joplin-desktop'              => 'version',
            '/snapcraft/v/mattermost-desktop/i386'     => 'version',
            '/snapcraft/v/telegram-desktop/arm64/edge' => 'version',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
