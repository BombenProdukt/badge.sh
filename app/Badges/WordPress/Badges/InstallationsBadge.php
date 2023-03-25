<?php

declare(strict_types=1);

namespace App\Badges\WordPress\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class InstallationsBadge extends AbstractBadge
{
    public function handle(string $extensionType, string $extension): array
    {
        return [
            'count' => $this->client->info($extensionType, $extension)['active_installs'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderDownloads($properties['count']);
    }

    public function keywords(): array
    {
        return [Category::DOWNLOADS];
    }

    public function routePaths(): array
    {
        return [
            '/wordpress/{extensionType}/installations/{extension}',
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
            '/wordpress/plugin/installations/bbpress' => 'active installations (plugin)',
            '/wordpress/theme/installations/twentyseventeen' => 'active installations (theme)',
        ];
    }
}
