<?php

declare(strict_types=1);

namespace App\Badges\PackageControl\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class DownloadsPerWeekBadge extends AbstractBadge
{
    public function handle(string $packageName): array
    {
        $platforms = $this->client->get($packageName)['installs']['daily']['data'];

        $total = 0;

        foreach ($platforms as $platform) {
            for ($i = 0; $i < 7; $i++) {
                $total += $platform['totals'][$i];
            }
        }

        return [
            'downloads' => $total,
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderDownloads($properties['downloads']);
    }

    public function keywords(): array
    {
        return [Category::LICENSE];
    }

    public function routePaths(): array
    {
        return [
            '/package-control/downloads-weekly/{packageName}',
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
            '/package-control/downloads-weekly/GitGutter' => 'weekly downloads',
        ];
    }
}
