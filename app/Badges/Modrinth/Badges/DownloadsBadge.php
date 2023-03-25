<?php

declare(strict_types=1);

namespace App\Badges\Modrinth\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class DownloadsBadge extends AbstractBadge
{
    protected array $routes = [
        '/modrinth/downloads/{projectId}',
    ];

    protected array $keywords = [
        Category::DOWNLOADS,
    ];

    public function handle(string $projectId): array
    {
        return $this->client->project($projectId);
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
                path: '/modrinth/downloads/AANobbMI',
                data: $this->render(['downloads' => '1000000']),
            ),
        ];
    }
}
