<?php

declare(strict_types=1);

namespace App\Badges\DUB;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class DownloadsBadge extends AbstractBadge
{
    protected string $route = '/dub/downloads/{package}';

    protected array $keywords = [
        Category::DOWNLOADS,
    ];

    public function handle(string $package): array
    {
        return [
            'downloads' => $this->client->get("{$package}/stats")['downloads']['total'],
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
                path: '/dub/downloads/vibe-d',
                data: $this->render(['downloads' => '1000000']),
            ),
        ];
    }
}
