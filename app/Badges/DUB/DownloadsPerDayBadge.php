<?php

declare(strict_types=1);

namespace App\Badges\DUB;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class DownloadsPerDayBadge extends AbstractBadge
{
    protected string $route = '/dub/downloads-daily/{package}';

    protected array $keywords = [
        Category::DOWNLOADS,
    ];

    public function handle(string $package): array
    {
        return $this->client->get("{$package}/stats");
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
                path: '/dub/downloads-daily/vibe-d',
                data: $this->render(['downloads' => '1000000']),
            ),
        ];
    }
}
