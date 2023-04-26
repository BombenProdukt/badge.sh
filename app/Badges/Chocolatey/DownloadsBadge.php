<?php

declare(strict_types=1);

namespace App\Badges\Chocolatey;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class DownloadsBadge extends AbstractBadge
{
    protected string $route = '/chocolatey/downloads/{project}/{channel?}';

    protected array $keywords = [
        Category::DOWNLOADS,
    ];

    public function handle(string $project, ?string $channel = 'latest'): array
    {
        return [
            'downloads' => $this->client->get($project, $channel !== 'latest')['DownloadCount'],
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
                path: '/chocolatey/downloads/git',
                data: $this->render(['downloads' => '1000000']),
            ),
        ];
    }
}
