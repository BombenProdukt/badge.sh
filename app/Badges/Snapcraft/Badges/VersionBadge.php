<?php

declare(strict_types=1);

namespace App\Badges\Snapcraft\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;
use Illuminate\Support\Arr;

final class VersionBadge extends AbstractBadge
{
    protected array $routes = [
        '/snapcraft/version/{snap}/{architecture?}/{channel?}',
    ];

    protected array $keywords = [
        Category::VERSION,
    ];

    public function handle(string $snap, ?string $architecture = null, ?string $channel = null): array
    {
        $channels = collect($this->client->get($snap, ['version'])['channel-map']);

        return match (true) {
            $architecture && $channel => $channels->firstWhere(fn (array $item) => Arr::get($item, 'channel.architecture') === $architecture && Arr::get($item, 'channel.name') === $channel),
            $architecture => $channels->firstWhere(fn (array $item) => Arr::get($item, 'channel.architecture') === $architecture),
            default => $channels->first(),
        };
    }

    public function render(array $properties): array
    {
        return $this->renderVersion($properties['version']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'version',
                path: '/snapcraft/version/joplin-desktop',
                data: $this->render([]),
            ),
            new BadgePreviewData(
                name: 'version',
                path: '/snapcraft/version/mattermost-desktop/i386',
                data: $this->render([]),
            ),
            new BadgePreviewData(
                name: 'version',
                path: '/snapcraft/version/telegram-desktop/arm64/edge',
                data: $this->render([]),
            ),
        ];
    }
}
