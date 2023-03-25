<?php

declare(strict_types=1);

namespace App\Badges\Spiget\Badges;

use App\Enums\Category;

final class SizeBadge extends AbstractBadge
{
    protected array $routes = [
        '/spiget/size/{resourceId}',
    ];

    protected array $keywords = [
        Category::SIZE,
    ];

    public function handle(string $resourceId): array
    {
        $file = $this->client->resource($resourceId)['file'];

        if ($file['type'] === 'external') {
            return [
                'size' => 'resource hosted externally',
            ];
        }

        return [
            'size' => $file['size'].' '.$file['sizeUnit'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderSize($properties['size']);
    }

    public function previews(): array
    {
        return [
            '/spiget/size/9089' => 'size',
        ];
    }
}
