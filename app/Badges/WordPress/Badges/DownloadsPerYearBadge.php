<?php

declare(strict_types=1);

namespace App\Badges\WordPress\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class DownloadsPerYearBadge extends AbstractBadge
{
    public function handle(string $extensionType, string $extension): array
    {
        return [
            'downloads' => $this->client->downloads($extensionType, $extension, 365),
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
            '/wordpress/{extensionType}/downloads-yearly/{extension}',
        ];
    }

    public function routeConstraints(Route $route): void
    {
        $route->whereIn('extensionType', ['plugin', 'theme']);
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/wordpress/plugin/downloads-yearly/bbpress'        => 'yearly downloads (plugin)',
            '/wordpress/theme/downloads-yearly/twentyseventeen' => 'yearly downloads (theme)',
        ];
    }
}
