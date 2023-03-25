<?php

declare(strict_types=1);

namespace App\Badges\Steam\Badges;

use App\Enums\Category;

final class FileSizeBadge extends AbstractBadge
{
    protected array $routes = [
        '/steam/file-size/{fileId}',
    ];

    protected array $keywords = [
        Category::SIZE,
    ];

    public function handle(string $fileId): array
    {
        return [
            'size' => $this->client->file($fileId)['file_size'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderSize($properties['size']);
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/steam/file-size/100' => 'file size',
        ];
    }
}
