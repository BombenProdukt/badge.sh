<?php

declare(strict_types=1);

namespace App\Badges\NPM\Badges;

use App\Badges\NPM\Client;
use App\Badges\Templates\DownloadsPerWeekTemplate;
use App\Contracts\Badge;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class WeeklyDownloadsBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $package, string $tag = 'latest'): array
    {
        $downloads = $this->client->api("downloads/point/last-week/{$package}")['downloads'];

        return DownloadsPerWeekTemplate::make($downloads);
    }

    public function service(): string
    {
        return 'npm';
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
            '/npm/downloads-weekly/{package}/{tag?}',
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
        $route->where('package', RoutePattern::PACKAGE_WITH_SCOPE->value);
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
            '/npm/downloads-weekly/express' => 'weekly downloads',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
