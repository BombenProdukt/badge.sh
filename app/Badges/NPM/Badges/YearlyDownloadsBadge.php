<?php

declare(strict_types=1);

namespace App\Badges\NPM\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class YearlyDownloadsBadge extends AbstractBadge
{
    protected array $routes = [
        '/npm/downloads-yearly/{package}/{tag?}',
    ];

    protected array $keywords = [
        Category::DOWNLOADS,
    ];

    public function handle(string $package, string $tag = 'latest'): array
    {
        return [
            'downloads' => $this->client->api("downloads/point/last-year/{$package}")['downloads'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderDownloadsPerYear($properties['downloads']);
    }

    public function routeConstraints(Route $route): void
    {
        $route->where('package', RoutePattern::PACKAGE_WITH_SCOPE->value);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'yearly downloads',
                path: '/npm/downloads-yearly/express',
                data: $this->render([]),
            ),
        ];
    }
}
