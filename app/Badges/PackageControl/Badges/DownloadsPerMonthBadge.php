<?php

declare(strict_types=1);

namespace App\Badges\PackageControl\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class DownloadsPerMonthBadge extends AbstractBadge
{
    public function handle(string $packageName): array
    {
        $platforms = $this->client->get($packageName)['installs']['daily']['data'];

        $total = 0;
        foreach ($platforms as $platform) {
            for ($i = 0; $i < 30; $i++) {
                $total += $platform['totals'][$i];
            }
        }

        return $this->renderDownloads($total);
    }

    public function keywords(): array
    {
        return [Category::LICENSE];
    }

    public function routePaths(): array
    {
        return [
            '/package-control/downloads-monthly/{packageName}',
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
            '/package-control/downloads-monthly/GitGutter' => 'monthly downloads',
        ];
    }
}
