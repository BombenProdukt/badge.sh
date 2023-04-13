<?php

declare(strict_types=1);

namespace App\Badges\NPM\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class DownloadsPerWeekBadge extends AbstractBadge
{
    protected string $route = '/npm/downloads-weekly/{package:packageWithScope}';

    protected array $keywords = [
        Category::DOWNLOADS,
    ];

    public function handle(string $package): array
    {
        return $this->client->api("downloads/point/last-week/{$package}");
    }

    public function render(array $properties): array
    {
        return $this->renderDownloadsPerWeek($properties['downloads']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'weekly downloads',
                path: '/npm/downloads-weekly/express',
                data: $this->render(['downloads' => '1000000']),
            ),
        ];
    }
}
