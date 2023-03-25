<?php

declare(strict_types=1);

namespace App\Badges\GalaxyToolShed\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class DownloadsBadge extends AbstractBadge
{
    protected array $routes = [
        '/galaxy-tool-shed/downloads/{user}/{repo}',
    ];

    protected array $keywords = [
        Category::DOWNLOADS,
    ];

    public function handle(string $user, string $repo): array
    {
        return [
            'downloads' => $this->client->fetchLastOrderedInstallableRevisionsSchema($user, $repo)['times_downloaded'],
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
                name: 'downloads',
                path: '/galaxy-tool-shed/downloads/iuc/sra_tools',
                data: $this->render(['downloads' => '1000000']),
            ),
        ];
    }
}
