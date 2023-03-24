<?php

declare(strict_types=1);

namespace App\Badges\WordPress\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class PhpVersionBadge extends AbstractBadge
{
    public function handle(string $extensionType, string $extension): array
    {
        return $this->renderVersion($this->client->info($extensionType, $extension)['requires_php'], 'PHP');
    }

    public function keywords(): array
    {
        return [Category::VERSION];
    }

    public function routePaths(): array
    {
        return [
            '/wordpress/{extensionType}/php-version/{extension}',
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
            '/wordpress/plugin/php-version/bbpress'        => 'required PHP version (plugin)',
            '/wordpress/theme/php-version/twentyseventeen' => 'required PHP version (theme)',
        ];
    }
}
