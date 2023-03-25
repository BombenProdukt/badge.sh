<?php

declare(strict_types=1);

namespace App\Badges\Steam\Badges;

use App\Enums\Category;

final class FileViewsBadge extends AbstractBadge
{
    protected array $routes = [
        '/steam/file-views/{fileId}',
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
        return $this->renderNumber('views', $properties['views']);
    }

    public function previews(): array
    {
        return [
            '/steam/file-views/100' => 'file views',
        ];
    }
}
