<?php

declare(strict_types=1);

namespace App\Badges\WordPress\Badges;

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

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/wordpress/plugin/php-version/bbpress' => 'required PHP version (plugin)',
            '/wordpress/theme/php-version/twentyseventeen' => 'required PHP version (theme)',
        ];
    }
}
