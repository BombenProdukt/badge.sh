<?php

declare(strict_types=1);

namespace App\Badges\Packagist\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class DailyDownloadsBadge extends AbstractBadge
{
    protected array $routes = [
        '/packagist/downloads-daily/{package:packageWithVendorOnly}',
    ];

    protected array $keywords = [
        Category::DOWNLOADS,
    ];

    public function handle(string $package, ?string $channel = null): array
    {
        return [
            'downloads' => $this->client->get($package)['downloads']['daily'],
        ];
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
                path: '/packagist/downloads-daily/monolog/monolog',
                data: $this->render(['downloads' => '1000000']),
            ),
        ];
    }
}
