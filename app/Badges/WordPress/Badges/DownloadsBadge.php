<?php

declare(strict_types=1);

namespace App\Badges\WordPress\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class DownloadsBadge extends AbstractBadge
{
    protected array $routes = [
        '/wordpress/{extensionType}/downloads/{extension}',
    ];

    protected array $keywords = [
        Category::DOWNLOADS,
    ];

    public function handle(string $extensionType, string $extension): array
    {
        return [
            'downloads' => $this->client->downloads($extensionType, $extension),
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderDownloads($properties['downloads']);
    }

    public function routeConstraints(Route $route): void
    {
        $route->whereIn('extensionType', ['plugin', 'theme']);
    }

    public function previews(): array
    {
        return [
            '/wordpress/plugin/downloads/bbpress' => 'total downloads (plugin)',
            '/wordpress/theme/downloads/twentyseventeen' => 'total downloads (theme)',
        ];
    }
}
