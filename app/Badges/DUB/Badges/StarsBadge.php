<?php

declare(strict_types=1);

namespace App\Badges\DUB\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class StarsBadge extends AbstractBadge
{
    public function handle(string $package): array
    {
        return $this->client->get("{$package}/stats");
    }

    public function render(array $properties): array
    {
        return $this->renderStars('stars', $properties['score']);
    }

    public function keywords(): array
    {
        return [Category::RATING];
    }

    public function routePaths(): array
    {
        return [
            '/dub/stars/{package}',
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
            '/dub/stars/silly' => 'stars',
        ];
    }
}
