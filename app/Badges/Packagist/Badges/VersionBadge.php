<?php

declare(strict_types=1);

namespace App\Badges\Packagist\Badges;

use App\Badges\Packagist\Concerns\HandlesVersions;
use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class VersionBadge extends AbstractBadge
{
    use HandlesVersions;

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

    public function keywords(): array
    {
        return [Category::VERSION];
    }

    public function routePaths(): array
    {
        return [
            '/packagist/version/{package}/{channel?}',
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
            '/packagist/version/monolog/monolog'        => 'version',
            '/packagist/version/monolog/monolog/pre'    => 'version (pre)',
            '/packagist/version/monolog/monolog/latest' => 'version (latest)',
        ];
    }
}
