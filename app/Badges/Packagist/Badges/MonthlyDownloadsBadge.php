<?php

declare(strict_types=1);

namespace App\Badges\Packagist\Badges;

use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class MonthlyDownloadsBadge extends AbstractBadge
{
    protected array $routes = [
        '/packagist/downloads-monthly/{package}',
    ];

    protected array $keywords = [
        Category::DOWNLOADS,
    ];

    public function handle(string $package, ?string $channel = null): array
    {
        return [
            'downloads' => $this->client->get($package)['downloads']['monthly'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderDownloadsPerMonth($properties['downloads']);
    }

    public function routeConstraints(Route $route): void
    {
        $route->where('package', RoutePattern::PACKAGE_WITH_VENDOR_ONLY->value);
    }

    public function previews(): array
    {
        return [
            '/packagist/downloads-monthly/monolog/monolog' => 'monthly downloads',
        ];
    }
}
