<?php

declare(strict_types=1);

namespace App\Badges\DUB\Badges;

use App\Badges\DUB\Client;
use App\Badges\Templates\DownloadsPerDayTemplate;
use App\Contracts\Badge;
use Illuminate\Routing\Route;

final class DailyDownloadsBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $package): array
    {
        $downloads = $this->client->get("{$package}/stats")['downloads'];

        return DownloadsPerDayTemplate::make($downloads['daily']);
    }

    public function service(): string
    {
        return 'DUB';
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
            '/dub/downloads-daily/{package}',
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
        //
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
            '/dub/downloads-daily/vibe-d' => 'daily downloads',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
