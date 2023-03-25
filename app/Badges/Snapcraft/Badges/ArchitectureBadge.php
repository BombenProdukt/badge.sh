<?php

declare(strict_types=1);

namespace App\Badges\Snapcraft\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class ArchitectureBadge extends AbstractBadge
{
    /**
     * The routes to access this badge.
     *
     * @var array<int, string>
     */
    protected array $routes = [
        '/snapcraft/architecture/{snap}',
    ];

    /**
     * The keywords that describe this badge.
     *
     * @var array<int, string>
     */
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
