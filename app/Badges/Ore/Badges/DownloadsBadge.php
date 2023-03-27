<?php

declare(strict_types=1);

namespace App\Badges\Ore\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class DownloadsBadge extends AbstractBadge
{
    protected string $route = '/ore/downloads/{pluginId}';

    protected array $keywords = [
        Category::DOWNLOADS,
    ];

    public function handle(string $pluginId): array
    {
        return $this->client->get($pluginId)['stats'];
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
                path: '/ore/downloads/nucleus',
                data: $this->render(['downloads' => '1000000']),
            ),
        ];
    }
}
