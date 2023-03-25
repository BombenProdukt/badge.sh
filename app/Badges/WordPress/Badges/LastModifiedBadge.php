<?php

declare(strict_types=1);

namespace App\Badges\WordPress\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;
use Illuminate\Routing\Route;

final class LastModifiedBadge extends AbstractBadge
{
    protected array $routes = [
        '/wordpress/{extensionType}/last-modified/{extension}',
    ];

    protected array $keywords = [
        Category::VERSION,
    ];

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

    public function routeConstraints(Route $route): void
    {
        $route->whereIn('extensionType', ['plugin', 'theme']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'last modified (plugin)',
                path: '/wordpress/plugin/last-modified/bbpress',
                data: $this->render([]),
            ),
            new BadgePreviewData(
                name: 'last modified (theme)',
                path: '/wordpress/theme/last-modified/twentyseventeen',
                data: $this->render([]),
            ),
        ];
    }
}
