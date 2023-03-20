<?php

declare(strict_types=1);

namespace App\Badges\Packagist\Badges;

use App\Badges\Packagist\Client;
use App\Badges\Packagist\Concerns\HandlesVersions;
use App\Badges\Templates\VersionTemplate;
use App\Contracts\Badge;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class VersionBadge implements Badge
{
    use HandlesVersions;

    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $package, ?string $channel = null): array
    {
        $version = $this->getVersion($this->client->get($package), $channel);

        return VersionTemplate::make($this->service(), $version);
    }

    public function service(): string
    {
        return 'Packagist';
    }

    public function title(): string
    {
        return '';
    }

    public function keywords(): array
    {
        return [
            //
        ];
    }

    public function routePaths(): array
    {
        return [
            '/packagist/{package}/version/{channel?}',
        ];
    }

    public function routeParameters(): array
    {
        return [
            //
        ];
    }

    public function routeConstraints(Route $route): void
    {
        $route->where('package', RoutePattern::PACKAGE_WITH_VENDOR_ONLY->value);
    }

    public function staticPreviews(): array
    {
        return [
            //
        ];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/packagist/monolog/monolog/version'        => 'version',
            '/packagist/monolog/monolog/version/pre'    => 'version (pre)',
            '/packagist/monolog/monolog/version/latest' => 'version (latest)',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}