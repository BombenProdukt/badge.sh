<?php

declare(strict_types=1);

namespace App\Badges\OpenVSX\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class DownloadsBadge extends AbstractBadge
{
    protected array $routes = [
        '/open-vsx/downloads/{extension:wildcard}',
    ];

    protected array $keywords = [
        Category::DOWNLOADS,
    ];

    public function handle(string $extension): array
    {
        return [
            'downloads' => $this->client->get($extension)['downloadCount'],
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
                path: '/open-vsx/downloads/idleberg/electron-builder',
                data: $this->render(['downloads' => '1000000']),
            ),
        ];
    }
}
