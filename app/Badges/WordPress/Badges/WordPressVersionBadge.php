<?php

declare(strict_types=1);

namespace App\Badges\WordPress\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class WordPressVersionBadge extends AbstractBadge
{
    public function handle(string $extensionType, string $extension): array
    {
        return [
            'version' => $this->client->info($extensionType, $extension)['requires'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderVersion($properties['version'], 'WordPress');
    }

    public function keywords(): array
    {
        return [Category::VERSION];
    }

    public function routePaths(): array
    {
        return [
            '/wordpress/{extensionType}/wordpress-version/{extension}',
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
            '/wordpress/plugin/wordpress-version/bbpress'        => 'required WordPress version (plugin)',
            '/wordpress/theme/wordpress-version/twentyseventeen' => 'required WordPress version (theme)',
        ];
    }
}
