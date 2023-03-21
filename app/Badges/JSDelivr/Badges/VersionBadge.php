<?php

declare(strict_types=1);

namespace App\Badges\JSDelivr\Badges;

use App\Badges\JSDelivr\Client;
use App\Badges\Templates\VersionTemplate;
use App\Contracts\Badge;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class VersionBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $package): array
    {
        $version = $this->client->cdn($package)['version'];

        return VersionTemplate::make($this->service(), $version);
    }

    public function service(): string
    {
        return 'jsDelivr';
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
            '/jsdelivr/version/npm/{package}',
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
        $route->where('package', RoutePattern::CATCH_ALL->value);
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
            '/jsdelivr/version/npm/lodash' => 'version',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
