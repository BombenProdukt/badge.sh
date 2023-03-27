<?php

declare(strict_types=1);

namespace App\Badges\Sourceforge\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class DownloadsBadge extends AbstractBadge
{
    protected string $route = '/sourceforge/downloads/{project}/{folder}';

    protected array $keywords = [
        Category::DOWNLOADS,
    ];

    public function handle(string $project, string $folder): array
    {
        return [
            'downloads' => $this->client->stats($project, $folder, 0)['total'],
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
                path: '/sourceforge/downloads/arianne/stendhal',
                data: $this->render(['downloads' => '1000000']),
            ),
        ];
    }
}
