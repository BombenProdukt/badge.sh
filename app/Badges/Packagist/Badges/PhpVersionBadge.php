<?php

declare(strict_types=1);

namespace App\Badges\Packagist\Badges;

use App\Badges\Packagist\Concerns\HandlesVersions;
use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;
use Illuminate\Support\Arr;

final class PhpVersionBadge extends AbstractBadge
{
    use HandlesVersions;

    public function handle(string $package, ?string $channel = null): array
    {
        $packageMeta = $this->client->get($package);

        $pkg = Arr::get($packageMeta['versions'], $this->getVersion($packageMeta, $channel));

        return [
            'version' => Arr::get($pkg, 'require.php', '*'),
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderVersion($properties['version'], 'php');
    }

    public function keywords(): array
    {
        return [Category::PLATFORM_SUPPORT];
    }

    public function routePaths(): array
    {
        return [
            '/packagist/php-version/{package}/{channel?}',
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
            '/packagist/php-version/monolog/monolog' => 'php',
        ];
    }
}
