<?php

declare(strict_types=1);

namespace App\Badges\Flathub\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class DownloadsBadge extends AbstractBadge
{
    public function handle(string $packageName): array
    {
        return [
            'downloads' => $this->client->downloads($packageName),
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
            '/flathub/downloads/{packageName}',
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
            '/flathub/downloads/org.mozilla.firefox' => 'downloads',
        ];
    }
}
