<?php

declare(strict_types=1);

namespace App\Badges\Packagist\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class TotalDownloadsBadge extends AbstractBadge
{
    protected string $route = '/packagist/downloads/{vendor}/{project}';

    protected array $keywords = [
        Category::DOWNLOADS,
    ];

    public function handle(string $vendor, string $project): array
    {
        return [
            'downloads' => $this->client->get($vendor, $project)['downloads']['total'],
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
                path: '/packagist/downloads/monolog/monolog',
                data: $this->render(['downloads' => '1000000']),
            ),
        ];
    }
}
