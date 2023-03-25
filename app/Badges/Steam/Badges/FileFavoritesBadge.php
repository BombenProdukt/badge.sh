<?php

declare(strict_types=1);

namespace App\Badges\Steam\Badges;

use App\Enums\Category;

final class FileFavoritesBadge extends AbstractBadge
{
    protected array $routes = [
        '/steam/file-favorites/{fileId}',
    ];

    protected array $keywords = [
        Category::SOCIAL,
    ];

    public function handle(string $fileId): array
    {
        return $this->client->file($fileId);
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('favorites', $properties['favorited']);
    }

    public function previews(): array
    {
        return [
            '/steam/file-favorites/100' => 'file favorites',
        ];
    }
}
