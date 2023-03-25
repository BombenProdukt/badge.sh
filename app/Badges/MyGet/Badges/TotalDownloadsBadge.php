<?php

declare(strict_types=1);

namespace App\Badges\MyGet\Badges;

use App\Enums\Category;

final class TotalDownloadsBadge extends AbstractBadge
{
    protected array $routes = [
        '/myget/downloads/{feed}/{project}',
    ];

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

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/myget/downloads/mongodb/MongoDB.Driver.Core' => 'total downloads',
        ];
    }
}
