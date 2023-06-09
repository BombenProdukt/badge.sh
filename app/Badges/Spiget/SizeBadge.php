<?php

declare(strict_types=1);

namespace App\Badges\Spiget;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class SizeBadge extends AbstractBadge
{
    protected string $route = '/spiget/size/{resourceId}';

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
            new BadgePreviewData(
                name: 'size',
                path: '/spiget/size/9089',
                data: $this->render(['size' => '1024']),
            ),
        ];
    }
}
