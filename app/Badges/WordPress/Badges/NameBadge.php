<?php

declare(strict_types=1);

namespace App\Badges\WordPress\Badges;

use App\Data\BadgePreviewData;
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
            new BadgePreviewData(
                name: 'version (plugin)',
                path: '/wordpress/plugin/version/bbpress',
                data: $this->render([]),
            ),
            new BadgePreviewData(
                name: 'version (theme)',
                path: '/wordpress/theme/version/twentyseventeen',
                data: $this->render([]),
            ),
        ];
    }
}
