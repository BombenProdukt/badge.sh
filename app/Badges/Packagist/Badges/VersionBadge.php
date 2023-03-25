<?php

declare(strict_types=1);

namespace App\Badges\Packagist\Badges;

use App\Badges\Packagist\Concerns\HandlesVersions;
use App\Data\BadgePreviewData;
use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class VersionBadge extends AbstractBadge
{
    use HandlesVersions;

    protected array $routes = [
        '/packagist/version/{package}/{channel?}',
    ];

    protected array $keywords = [
        Category::VERSION,
    ];

    public function handle(string $package, ?string $channel = null): array
    {
        return [
            'version' => $this->getVersion($this->client->get($package), $channel),
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderVersion($properties['version']);
    }

    public function routeConstraints(Route $route): void
    {
        $route->where('package', RoutePattern::PACKAGE_WITH_VENDOR_ONLY->value);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'version',
                path: '/packagist/version/monolog/monolog',
                data: $this->render([]),
            ),
            new BadgePreviewData(
                name: 'version (pre)',
                path: '/packagist/version/monolog/monolog/pre',
                data: $this->render([]),
            ),
            new BadgePreviewData(
                name: 'version (latest)',
                path: '/packagist/version/monolog/monolog/latest',
                data: $this->render([]),
            ),
        ];
    }
}
