<?php

declare(strict_types=1);

namespace App\Badges\Snapcraft\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;
use Illuminate\Support\Arr;

final class SizeBadge extends AbstractBadge
{
    protected array $routes = [
        '/snapcraft/size/{snap}/{architecture?}/{channel?}',
    ];

    protected array $keywords = [
        Category::SIZE,
    ];

    public function handle(string $snap, ?string $architecture = null, ?string $channel = null): array
    {
        $channels = collect($this->client->get($snap, ['size'])['channel-map']);

        $channel = match (true) {
            $architecture && $channel => $channels->firstWhere(fn (array $item) => Arr::get($item, 'channel.architecture') === $architecture && Arr::get($item, 'channel.name') === $channel),
            $architecture => $channels->firstWhere(fn (array $item) => Arr::get($item, 'channel.architecture') === $architecture),
            default => $channels->first(),
        };

        return $channel['download'];
    }

    public function render(array $properties): array
    {
        return $this->renderSize($properties['size']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'distribution size',
                path: '/snapcraft/size/beekeeper-studio',
                data: $this->render(['size' => '1024']),
            ),
            new BadgePreviewData(
                name: 'distribution size',
                path: '/snapcraft/size/beekeeper-studio/arm64',
                data: $this->render(['size' => '1024']),
            ),
            new BadgePreviewData(
                name: 'distribution size',
                path: '/snapcraft/size/beekeeper-studio/armhf/edge',
                data: $this->render(['size' => '1024']),
            ),
        ];
    }
}
