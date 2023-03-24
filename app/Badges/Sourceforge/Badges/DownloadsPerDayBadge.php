<?php

declare(strict_types=1);

namespace App\Badges\Sourceforge\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class DownloadsPerDayBadge extends AbstractBadge
{
    public function handle(string $project, string $folder): array
    {
        return $this->renderDownloads($this->client->stats($project, $folder, 1)['total']);
    }

    public function keywords(): array
    {
        return [Category::DOWNLOADS];
    }

    public function routePaths(): array
    {
        return [
            '/sourceforge/downloads-daily/{project}/{folder}',
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
            '/sourceforge/downloads-daily/arianne/stendhal' => 'daily downloads',
        ];
    }
}
