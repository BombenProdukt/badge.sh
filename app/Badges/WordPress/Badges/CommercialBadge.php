<?php

declare(strict_types=1);

namespace App\Badges\WordPress\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class CommercialBadge extends AbstractBadge
{
    public function handle(string $extensionType, string $extension): array
    {
        return $this->client->info($extensionType, $extension);
    }

    public function render(array $properties): array
    {
        return $this->renderText('commercial', $properties['is_commercial'] ? 'yes' : 'no');
    }

    public function keywords(): array
    {
        return [Category::VERSION];
    }

    public function routePaths(): array
    {
        return [
            '/wordpress/{extensionType}/commercial/{extension}',
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
            '/wordpress/plugin/commercial/bbpress'        => 'commercial status (plugin)',
            '/wordpress/theme/commercial/twentyseventeen' => 'commercial status (theme)',
        ];
    }
}
