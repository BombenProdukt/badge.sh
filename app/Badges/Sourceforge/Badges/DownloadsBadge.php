<?php

declare(strict_types=1);

namespace App\Badges\Sourceforge\Badges;

use App\Enums\Category;

final class DownloadsBadge extends AbstractBadge
{
    protected array $routes = [
        '/sourceforge/downloads/{project}/{folder}',
    ];

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
            '/sourceforge/downloads/arianne/stendhal' => 'total downloads',
        ];
    }
}
