<?php

declare(strict_types=1);

namespace App\Badges\WordPress\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class DownloadsPerMonthBadge extends AbstractBadge
{
    public function handle(string $extensionType, string $extension): array
    {
        return [
            'downloads' => $this->client->downloads($extensionType, $extension, 30),
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderDownloadsPerMonth($properties['downloads']);
    }

    public function keywords(): array
    {
        return [Category::DOWNLOADS];
    }

    public function routePaths(): array
    {
        return [
            '/wordpress/{extensionType}/downloads-monthly/{extension}',
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
            '/wordpress/plugin/downloads-monthly/bbpress'        => 'monthly downloads (plugin)',
            '/wordpress/theme/downloads-monthly/twentyseventeen' => 'monthly downloads (theme)',
        ];
    }
}
