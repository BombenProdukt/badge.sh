<?php

declare(strict_types=1);

namespace App\Badges\Steam\Badges;

use App\Data\BadgePreviewData;
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
            new BadgePreviewData(
                name: 'file favorites',
                path: '/steam/file-favorites/100',
                data: $this->render([]),
            ),
        ];
    }
}
