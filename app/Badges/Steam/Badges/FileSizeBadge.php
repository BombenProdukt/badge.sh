<?php

declare(strict_types=1);

namespace App\Badges\Steam\Badges;

use App\Data\BadgePreviewData;
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

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'file size',
                path: '/steam/file-size/100',
                data: $this->render(['size' => '1024']),
            ),
        ];
    }
}
