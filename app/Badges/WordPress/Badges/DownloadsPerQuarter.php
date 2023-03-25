<?php

declare(strict_types=1);

namespace App\Badges\WordPress\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class DownloadsPerQuarter extends AbstractBadge
{
    protected array $routes = [
        '/wordpress/{extensionType}/downloads-quarterly/{extension}',
    ];

    protected array $keywords = [
        Category::DOWNLOADS,
    ];

    public function handle(string $extensionType, string $extension): array
    {
        return $this->renderDownloads($this->client->downloads($extensionType, $extension, 90));
    }

    public function render(array $properties): array
    {
        return $this->renderDownloads($properties['downloads']);
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
            '/wordpress/plugin/downloads-quarterly/bbpress' => 'quarterly downloads (plugin)',
            '/wordpress/theme/downloads-quarterly/twentyseventeen' => 'quarterly downloads (theme)',
        ];
    }
}
