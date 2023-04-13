<?php

declare(strict_types=1);

namespace App\Badges\MyGet\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class DownloadsBadge extends AbstractBadge
{
    protected string $route = '/myget/downloads/{feed}/{project}';

    protected array $keywords = [
        Category::DOWNLOADS,
    ];

    public function handle(string $feed, string $project): array
    {
        return [
            'downloads' => $this->client->get($feed, $project)['totaldownloads'],
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
                path: '/myget/downloads/mongodb/MongoDB.Driver.Core',
                data: $this->render(['downloads' => '1000000']),
            ),
        ];
    }
}
