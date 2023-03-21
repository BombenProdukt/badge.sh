<?php

declare(strict_types=1);

namespace App\Badges\Packagist\Badges;

use App\Badges\AbstractBadge;
use App\Badges\Packagist\Client;
use App\Badges\Templates\DownloadsPerMonthTemplate;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class MonthlyDownloadsBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $package, ?string $channel = null): array
    {
        $packageMeta = $this->client->get($package);

        return DownloadsPerMonthTemplate::make($packageMeta['downloads']['monthly']);
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
        return [];
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
