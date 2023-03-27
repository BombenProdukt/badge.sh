<?php

declare(strict_types=1);

namespace App\Badges\Snapcraft\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class ArchitectureBadge extends AbstractBadge
{
    protected string $route = '/snapcraft/architecture/{snap}';

    protected array $keywords = [
        Category::PLATFORM_SUPPORT,
    ];

    public function handle(string $snap): array
    {
        return [
            'architectures' => collect($this->client->get($snap)['channel-map'])->map->channel->map->architecture->unique()->toArray(),
        ];
    }

    public function render(array $properties): array
    {
        return [
            'label' => 'architecture',
            'message' => \implode(' | ', $properties['architectures']),
            'messageColor' => 'blue.600',
        ];
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'supported architectures',
                path: '/snapcraft/architecture/telegram-desktop',
                data: $this->render(['architectures' => ['amd64', 'arm64', 'armhf', 'i386', 'ppc64el', 's390x']]),
            ),
        ];
    }
}
