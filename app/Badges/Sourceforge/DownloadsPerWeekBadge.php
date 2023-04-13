<?php

declare(strict_types=1);

namespace App\Badges\Sourceforge;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class DownloadsPerWeekBadge extends AbstractBadge
{
    protected string $route = '/sourceforge/downloads-weekly/{project}/{folder}';

    protected array $keywords = [
        Category::DOWNLOADS,
    ];

    public function handle(string $project, string $folder): array
    {
        return [
            'downloads' => $this->client->stats($project, $folder, 6)['total'],
        ];
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
                path: '/sourceforge/downloads-weekly/arianne/stendhal',
                data: $this->render(['downloads' => '1000000']),
            ),
        ];
    }
}
