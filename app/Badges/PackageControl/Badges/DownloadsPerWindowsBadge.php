<?php

declare(strict_types=1);

namespace App\Badges\PackageControl\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class DownloadsPerWindowsBadge extends AbstractBadge
{
    public function handle(string $packageName): array
    {
        return [
            'downloads' => $this->client->get($packageName)['installs']['windows'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderDownloadsPerWindows($properties['downloads']);
    }

    public function keywords(): array
    {
        return [Category::LICENSE];
    }

    public function routePaths(): array
    {
        return [
            '/package-control/downloads-windows/{packageName}',
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
            '/package-control/downloads-windows/GitGutter' => 'windows downloads',
        ];
    }
}
