<?php

declare(strict_types=1);

namespace App\Badges\EclipseMarketplace\Badges;

use App\Enums\Category;

final class FavoritesBadge extends AbstractBadge
{
    protected array $routes = [
        '/eclipse-marketplace/favorites/{name}',
    ];

    protected array $keywords = [
        Category::SOCIAL,
    ];

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

    public function previews(): array
    {
        return [
            '/eclipse-marketplace/favorites/notepad4e' => 'favorites',
        ];
    }
}
