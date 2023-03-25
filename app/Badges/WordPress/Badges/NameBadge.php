<?php

declare(strict_types=1);

namespace App\Badges\WordPress\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class NameBadge extends AbstractBadge
{
    protected array $routes = [
        '/wordpress/{extensionType}/version/{extension}',
    ];

    protected array $keywords = [
        Category::VERSION,
    ];

    public function handle(string $extensionType, string $extension): array
    {
        return $this->client->info($extensionType, $extension);
    }

    public function render(array $properties): array
    {
        return $this->renderDownloads($properties['version']);
    }

    public function routeConstraints(Route $route): void
    {
        $route->whereIn('extensionType', ['plugin', 'theme']);
    }

    public function previews(): array
    {
        return [
            '/wordpress/plugin/version/bbpress' => 'version (plugin)',
            '/wordpress/theme/version/twentyseventeen' => 'version (theme)',
        ];
    }
}
