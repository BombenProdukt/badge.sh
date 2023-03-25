<?php

declare(strict_types=1);

namespace App\Badges\WordPress\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;
use Illuminate\Routing\Route;

final class PhpVersionBadge extends AbstractBadge
{
    protected array $routes = [
        '/wordpress/{extensionType}/php-version/{extension}',
    ];

    protected array $keywords = [
        Category::VERSION,
    ];

    public function handle(string $extensionType, string $extension): array
    {
        return [
            'version' => $this->client->info($extensionType, $extension)['requires_php'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderVersion($properties['version'], 'PHP');
    }

    public function routeConstraints(Route $route): void
    {
        $route->whereIn('extensionType', ['plugin', 'theme']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'required PHP version (plugin)',
                path: '/wordpress/plugin/php-version/bbpress',
                data: $this->render(['version' => '1.0.0']),
            ),
            new BadgePreviewData(
                name: 'required PHP version (theme)',
                path: '/wordpress/theme/php-version/twentyseventeen',
                data: $this->render(['version' => '1.0.0']),
            ),
        ];
    }
}
