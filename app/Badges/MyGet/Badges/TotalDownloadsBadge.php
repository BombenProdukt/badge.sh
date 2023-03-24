<?php

declare(strict_types=1);

namespace App\Badges\MyGet\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class TotalDownloadsBadge extends AbstractBadge
{
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

    public function keywords(): array
    {
        return [Category::DOWNLOADS];
    }

    public function routePaths(): array
    {
        return [
            '/myget/downloads/{feed}/{project}',
        ];
    }

    public function routeParameters(): array
    {
        return [];
    }

    public function routeConstraints(Route $route): void
    {
        //
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
