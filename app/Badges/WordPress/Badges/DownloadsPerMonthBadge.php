<?php

declare(strict_types=1);

namespace App\Badges\WordPress\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;
use Illuminate\Routing\Route;

final class DownloadsPerMonthBadge extends AbstractBadge
{
    protected array $routes = [
        '/wordpress/{extensionType}/downloads-monthly/{extension}',
    ];

    protected array $keywords = [
        Category::DOWNLOADS,
    ];

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

    public function routeConstraints(Route $route): void
    {
        $route->whereIn('extensionType', ['plugin', 'theme']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'monthly downloads (plugin)',
                path: '/wordpress/plugin/downloads-monthly/bbpress',
                data: $this->render([]),
            ),
            new BadgePreviewData(
                name: 'monthly downloads (theme)',
                path: '/wordpress/theme/downloads-monthly/twentyseventeen',
                data: $this->render([]),
            ),
        ];
    }
}
