<?php

declare(strict_types=1);

namespace App\Badges\NPM\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class YearlyDownloadsBadge extends AbstractBadge
{
    protected string $route = '/npm/downloads-yearly/{package:packageWithScope}/{tag?}';

    protected array $keywords = [
        Category::DOWNLOADS,
    ];

    public function handle(string $package, string $tag = 'latest'): array
    {
        return [
            'downloads' => $this->client->api("downloads/point/last-year/{$package}")['downloads'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderDownloadsPerYear($properties['downloads']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'yearly downloads',
                path: '/npm/downloads-yearly/express',
                data: $this->render(['downloads' => '1000000']),
            ),
        ];
    }
}
