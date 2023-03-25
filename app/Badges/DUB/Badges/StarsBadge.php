<?php

declare(strict_types=1);

namespace App\Badges\DUB\Badges;

use App\Enums\Category;

final class StarsBadge extends AbstractBadge
{
    protected array $routes = [
        '/dub/stars/{package}',
    ];

    protected array $keywords = [
        Category::RATING,
    ];

    public function handle(string $package): array
    {
        return $this->client->get("{$package}/stats");
    }

    public function render(array $properties): array
    {
        return $this->renderStars('stars', $properties['score']);
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/dub/stars/silly' => 'stars',
        ];
    }
}
