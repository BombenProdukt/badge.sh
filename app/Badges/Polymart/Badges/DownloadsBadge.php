<?php

declare(strict_types=1);

namespace App\Badges\Polymart\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class DownloadsBadge extends AbstractBadge
{
    public function handle(string $resourceId): array
    {
        return $this->renderDownloads($this->client->get($resourceId)['downloads']);
    }

    public function keywords(): array
    {
        return [Category::DOWNLOADS];
    }

    public function routePaths(): array
    {
        return [
            '/polymart/downloads/{resourceId}',
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
            '/polymart/downloads/323' => 'total downloads',
        ];
    }
}
