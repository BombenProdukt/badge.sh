<?php

declare(strict_types=1);

namespace App\Badges\Flathub;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class DownloadsBadge extends AbstractBadge
{
    protected string $route = '/flathub/downloads/{packageName}';

    protected array $keywords = [
        Category::DOWNLOADS,
    ];

    public function handle(string $packageName): array
    {
        return [
            'downloads' => $this->client->downloads($packageName),
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
                name: 'downloads',
                path: '/flathub/downloads/org.mozilla.firefox',
                data: $this->render(['downloads' => '1000000']),
            ),
        ];
    }
}
