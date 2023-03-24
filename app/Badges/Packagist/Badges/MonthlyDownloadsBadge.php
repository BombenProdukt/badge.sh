<?php

declare(strict_types=1);

namespace App\Badges\Packagist\Badges;

use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class MonthlyDownloadsBadge extends AbstractBadge
{
    public function handle(string $package, ?string $channel = null): array
    {
        $packageMeta = $this->client->get($package);

        return $this->renderDownloadsPerMonth($packageMeta['downloads']['monthly']);
    }

    public function keywords(): array
    {
        return [Category::DOWNLOADS];
    }

    public function routePaths(): array
    {
        return [
            '/packagist/downloads-monthly/{package}',
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
            '/packagist/downloads-monthly/monolog/monolog' => 'monthly downloads',
        ];
    }
}
