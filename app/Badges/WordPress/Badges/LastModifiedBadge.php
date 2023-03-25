<?php

declare(strict_types=1);

namespace App\Badges\WordPress\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class LastModifiedBadge extends AbstractBadge
{
    public function handle(string $extensionType, string $extension): array
    {
        return [
            'date' => $this->client->info($extensionType, $extension)['last_updated'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderDateDiff('commercial', $properties['date']);
    }

    public function keywords(): array
    {
        return [Category::VERSION];
    }

    public function routePaths(): array
    {
        return [
            '/wordpress/{extensionType}/last-modified/{extension}',
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
            '/wordpress/plugin/last-modified/bbpress' => 'last modified (plugin)',
            '/wordpress/theme/last-modified/twentyseventeen' => 'last modified (theme)',
        ];
    }
}
