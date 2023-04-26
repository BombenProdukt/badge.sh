<?php

declare(strict_types=1);

namespace App\Badges\PowerShellGallery;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class DownloadsBadge extends AbstractBadge
{
    protected string $route = '/powershellgallery/downloads/{project}/{channel?}';

    protected array $keywords = [
        Category::DOWNLOADS,
    ];

    public function handle(string $project, ?string $channel = 'latest'): array
    {
        return [
            'downloads' => $this->client->get($project, $channel !== 'latest')->filterXPath('//m:properties/d:DownloadCount')->text(),
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
                name: 'total downloads',
                path: '/powershellgallery/downloads/Azure.Storage',
                data: $this->render(['downloads' => '1000000']),
            ),
        ];
    }
}
