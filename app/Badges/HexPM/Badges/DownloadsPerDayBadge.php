<?php

declare(strict_types=1);

namespace App\Badges\HexPM\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class DownloadsPerDayBadge extends AbstractBadge
{
    public function handle(string $packageName): array
    {
        return $this->renderDownloads($this->client->get($packageName)['downloads']['day']);
    }

    public function keywords(): array
    {
        return [Category::DOWNLOADS];
    }

    public function routePaths(): array
    {
        return [
            '/hex/downloads-daily/{packageName}',
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
            '/hex/downloads-daily/plug' => 'daily downloads',
        ];
    }
}
