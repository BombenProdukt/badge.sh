<?php

declare(strict_types=1);

namespace App\Badges\WordPress\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class DownloadsPerQuarter extends AbstractBadge
{
    public function handle(string $extensionType, string $extension): array
    {
        return $this->renderDownloads($this->client->downloads($extensionType, $extension, 90));
    }

    public function keywords(): array
    {
        return [Category::DOWNLOADS];
    }

    public function routePaths(): array
    {
        return [
            '/wordpress/{extensionType}/downloads-quarterly/{extension}',
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
            '/wordpress/plugin/downloads-quarterly/bbpress'        => 'quarterly downloads (plugin)',
            '/wordpress/theme/downloads-quarterly/twentyseventeen' => 'quarterly downloads (theme)',
        ];
    }
}
