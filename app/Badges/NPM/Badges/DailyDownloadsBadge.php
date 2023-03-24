<?php

declare(strict_types=1);

namespace App\Badges\NPM\Badges;

use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class DailyDownloadsBadge extends AbstractBadge
{
    public function handle(string $package, string $tag = 'latest'): array
    {
        return $this->client->api("downloads/point/last-day/{$package}");
    }

    public function render(array $properties): array
    {
        return $this->renderDownloadsPerDay($properties['downloads']);
    }

    public function keywords(): array
    {
        return [Category::DOWNLOADS];
    }

    public function routePaths(): array
    {
        return [
            '/npm/downloads-daily/{package}/{tag?}',
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
            '/npm/downloads-daily/express' => 'daily downloads',
        ];
    }
}
