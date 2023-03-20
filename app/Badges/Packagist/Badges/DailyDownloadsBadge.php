<?php

declare(strict_types=1);

namespace App\Badges\Packagist\Badges;

use App\Badges\Packagist\Client;
use App\Badges\Templates\DownloadsPerDayTemplate;
use App\Contracts\Badge;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class DailyDownloadsBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $package, ?string $channel = null): array
    {
        $packageMeta = $this->client->get($package);

        return DownloadsPerDayTemplate::make($packageMeta['downloads']['daily']);
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
            '/packagist/{package}/downloads/daily',
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
            '/packagist/monolog/monolog/downloads/daily' => 'daily downloads',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}