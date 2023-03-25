<?php

declare(strict_types=1);

namespace App\Badges\Snapcraft\Badges;

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
            '/snapcraft/version/joplin-desktop' => 'version',
            '/snapcraft/version/mattermost-desktop/i386' => 'version',
            '/snapcraft/version/telegram-desktop/arm64/edge' => 'version',
        ];
    }
}
