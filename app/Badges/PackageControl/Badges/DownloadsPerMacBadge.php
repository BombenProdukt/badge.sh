<?php

declare(strict_types=1);

namespace App\Badges\PackageControl\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class DownloadsPerMacBadge extends AbstractBadge
{
    public function handle(string $packageName): array
    {
        return [
            'downloads' => $this->client->get($packageName)['installs']['osx'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderDownloadsPerMac($properties['downloads']);
    }

    public function keywords(): array
    {
        return [Category::LICENSE];
    }

    public function routePaths(): array
    {
        return [
            '/package-control/downloads-mac/{packageName}',
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
            '/package-control/downloads-mac/GitGutter' => 'macOS downloads',
        ];
    }
}
