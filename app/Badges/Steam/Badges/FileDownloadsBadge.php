<?php

declare(strict_types=1);

namespace App\Badges\Steam\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class FileDownloadsBadge extends AbstractBadge
{
    protected string $route = '/steam/file-downloads/{fileId}';

    protected array $keywords = [
        Category::DOWNLOADS,
    ];

    public function handle(string $fileId): array
    {
        return [
            'downloads' => $this->client->file($fileId)['lifetime_subscriptions'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderDownloads($properties['downloads']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'file downloads',
                path: '/steam/file-downloads/{fileId}',
                data: $this->render(['downloads' => '1000000']),
            ),
        ];
    }
}
