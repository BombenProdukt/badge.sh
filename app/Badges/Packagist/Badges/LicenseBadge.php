<?php

declare(strict_types=1);

namespace App\Badges\Packagist\Badges;

use App\Badges\Packagist\Concerns\HandlesVersions;
use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class LicenseBadge extends AbstractBadge
{
    use HandlesVersions;

    public function handle(string $package, ?string $channel = null): array
    {
        $packageMeta = $this->client->get($package);

        return [
            'license' => $packageMeta['versions'][$this->getVersion($packageMeta, $channel)]['license'][0],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderLicense($properties['license']);
    }

    public function keywords(): array
    {
        return [Category::LICENSE];
    }

    public function routePaths(): array
    {
        return [
            '/packagist/license/{package}/{channel?}',
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
            '/packagist/license/monolog/monolog' => 'license',
        ];
    }
}
