<?php

declare(strict_types=1);

namespace App\Badges\Packagist\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class MonthlyDownloadsBadge extends AbstractBadge
{
    protected array $routes = [
        '/packagist/downloads-monthly/{package:wildcard}',
    ];

    protected array $keywords = [
        Category::DOWNLOADS,
    ];

    public function handle(string $package, ?string $channel = null): array
    {
        return [
            'downloads' => $this->client->get($package)['downloads']['monthly'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderDownloadsPerMonth($properties['downloads']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'monthly downloads',
                path: '/packagist/downloads-monthly/monolog/monolog',
                data: $this->render(['downloads' => '1000000']),
            ),
        ];
    }
}
