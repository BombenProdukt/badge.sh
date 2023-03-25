<?php

declare(strict_types=1);

namespace App\Badges\NPM\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class WeeklyDownloadsBadge extends AbstractBadge
{
    protected array $routes = [
        '/npm/downloads-weekly/{package}/{tag?}',
    ];

    protected array $keywords = [
        Category::DOWNLOADS,
    ];

    public function handle(string $package, string $tag = 'latest'): array
    {
        return $this->client->api("downloads/point/last-week/{$package}");
    }

    public function render(array $properties): array
    {
        return $this->renderDownloadsPerWeek($properties['downloads']);
    }

    public function routeConstraints(Route $route): void
    {
        $route->where('package', RoutePattern::PACKAGE_WITH_SCOPE->value);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'weekly downloads',
                path: '/npm/downloads-weekly/express',
                data: $this->render([]),
            ),
        ];
    }
}
