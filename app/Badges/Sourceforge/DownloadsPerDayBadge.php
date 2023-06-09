<?php

declare(strict_types=1);

namespace App\Badges\Sourceforge;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class DownloadsPerDayBadge extends AbstractBadge
{
    protected string $route = '/sourceforge/downloads-daily/{project}/{folder}';

    protected array $keywords = [
        Category::DOWNLOADS,
    ];

    public function handle(string $project, string $folder): array
    {
        return [
            'downloads' => $this->client->stats($project, $folder, 1)['total'],
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
                path: '/sourceforge/downloads-daily/arianne/stendhal',
                data: $this->render(['downloads' => '1000000']),
            ),
        ];
    }
}
