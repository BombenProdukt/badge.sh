<?php

declare(strict_types=1);

namespace App\Badges\NPM\Badges;

use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class YearlyDownloadsBadge extends AbstractBadge
{
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

    public function keywords(): array
    {
        return [Category::DOWNLOADS];
    }

    public function routePaths(): array
    {
        return [
            '/npm/downloads-yearly/{package}/{tag?}',
        ];
    }

    public function routeParameters(): array
    {
        return [];
    }

    public function routeConstraints(Route $route): void
    {
        $route->where('package', RoutePattern::PACKAGE_WITH_SCOPE->value);
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/npm/downloads-yearly/express' => 'yearly downloads',
        ];
    }
}
