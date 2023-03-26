<?php

declare(strict_types=1);

namespace App\Badges\NPM\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class DailyDownloadsBadge extends AbstractBadge
{
    protected array $routes = [
        '/npm/downloads-daily/{package:wildcard}/{tag?}',
    ];

    protected array $keywords = [
        Category::DOWNLOADS,
    ];

    public function handle(string $package, string $tag = 'latest'): array
    {
        return $this->client->api("downloads/point/last-day/{$package}");
    }

    public function render(array $properties): array
    {
        return $this->renderDownloadsPerDay($properties['downloads']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'daily downloads',
                path: '/npm/downloads-daily/express',
                data: $this->render(['downloads' => '1000000']),
            ),
        ];
    }
}
