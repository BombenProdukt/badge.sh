<?php

declare(strict_types=1);

namespace App\Badges\Packagist\Badges;

use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class DailyDownloadsBadge extends AbstractBadge
{
    public function handle(string $package, ?string $channel = null): array
    {
        return [
            'downloads' => $this->client->get($package)['downloads']['daily'],
        ];
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
            '/packagist/downloads-daily/{package}',
        ];
    }

    public function routeParameters(): array
    {
        return [];
    }

    public function routeConstraints(Route $route): void
    {
        $route->where('package', RoutePattern::PACKAGE_WITH_VENDOR_ONLY->value);
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/packagist/downloads-daily/monolog/monolog' => 'daily downloads',
        ];
    }
}
