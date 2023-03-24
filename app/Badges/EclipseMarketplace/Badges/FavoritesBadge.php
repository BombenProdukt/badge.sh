<?php

declare(strict_types=1);

namespace App\Badges\EclipseMarketplace\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class FavoritesBadge extends AbstractBadge
{
    public function handle(string $name): array
    {
        return [
            'favorites' => $this->client->get($name)->filterXPath('//favorited')->text(),
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('favorites', $properties['favorites']);
    }

    public function keywords(): array
    {
        return [Category::SOCIAL];
    }

    public function routePaths(): array
    {
        return [
            '/eclipse-marketplace/favorites/{name}',
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
            '/eclipse-marketplace/favorites/notepad4e' => 'favorites',
        ];
    }
}
