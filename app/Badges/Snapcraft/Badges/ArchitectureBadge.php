<?php

declare(strict_types=1);

namespace App\Badges\Snapcraft\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class ArchitectureBadge extends AbstractBadge
{
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

    public function keywords(): array
    {
        return [Category::PLATFORM_SUPPORT];
    }

    public function routePaths(): array
    {
        return [
            '/snapcraft/architecture/{snap}',
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
            '/snapcraft/architecture/telegram-desktop' => 'supported architectures',
        ];
    }
}
