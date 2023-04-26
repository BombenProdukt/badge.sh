<?php

declare(strict_types=1);

namespace App\Badges\Steam;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class FileViewsBadge extends AbstractBadge
{
    protected string $route = '/steam/file-views/{fileId}';

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
            new BadgePreviewData(
                name: 'file views',
                path: '/steam/file-views/100',
                data: $this->render(['views' => '1000000']),
            ),
        ];
    }
}
