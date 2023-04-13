<?php

declare(strict_types=1);

namespace App\Badges\EclipseMarketplace;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class DownloadsBadge extends AbstractBadge
{
    protected string $route = '/eclipse-marketplace/downloads/{name}';

    protected array $keywords = [
        Category::DOWNLOADS,
    ];

    public function handle(string $name): array
    {
        return [
            'downloads' => $this->client->get($name)->filterXPath('//installstotal')->text(),
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
                path: '/eclipse-marketplace/downloads/notepad4e',
                data: $this->render(['downloads' => '1000000']),
            ),
        ];
    }
}
