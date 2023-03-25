<?php

declare(strict_types=1);

namespace App\Badges\WordPress\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class CommercialBadge extends AbstractBadge
{
    protected array $routes = [
        '/wordpress/{extensionType}/commercial/{extension}',
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
        return $this->renderText('commercial', $properties['is_commercial'] ? 'yes' : 'no');
    }

    public function routeConstraints(Route $route): void
    {
        $route->whereIn('extensionType', ['plugin', 'theme']);
    }

    public function previews(): array
    {
        return [
            '/wordpress/plugin/commercial/bbpress' => 'commercial status (plugin)',
            '/wordpress/theme/commercial/twentyseventeen' => 'commercial status (theme)',
        ];
    }
}
