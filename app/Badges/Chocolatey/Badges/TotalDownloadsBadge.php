<?php

declare(strict_types=1);

namespace App\Badges\Chocolatey\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class TotalDownloadsBadge extends AbstractBadge
{
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

    public function keywords(): array
    {
        return [Category::DOWNLOADS];
    }

    public function routePaths(): array
    {
        return [
            '/chocolatey/downloads/{project}/{channel?}',
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
            '/chocolatey/downloads/git' => 'total downloads',
        ];
    }
}
