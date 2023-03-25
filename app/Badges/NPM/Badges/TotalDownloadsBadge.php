<?php

declare(strict_types=1);

namespace App\Badges\NPM\Badges;

use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class TotalDownloadsBadge extends AbstractBadge
{
    protected array $routes = [
        '/npm/downloads/{package}',
    ];

    protected array $keywords = [
        Category::DOWNLOADS,
    ];

    public function handle(string $package, string $tag = 'latest'): array
    {
        return [
            'downloads' => collect($this->client->api('downloads/range/2005-01-01:'.\date('Y')."-01-01/{$package}")['downloads'])->sum('downloads'),
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderDownloads($properties['downloads']);
    }

    public function routeConstraints(Route $route): void
    {
        $route->where('package', RoutePattern::PACKAGE_WITH_SCOPE->value);
    }

    public function previews(): array
    {
        return [
            '/npm/downloads/express' => 'total downloads',
        ];
    }
}
