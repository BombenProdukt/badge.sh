<?php

declare(strict_types=1);

namespace App\Badges\DUB\Badges;

use App\Badges\DUB\Client;
use App\Badges\Templates\DownloadsPerMonthTemplate;
use App\Contracts\Badge;
use Illuminate\Routing\Route;

final class MonthlyDownloadsBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $package): array
    {
        $downloads = $this->client->get("{$package}/stats")['downloads'];

        return DownloadsPerMonthTemplate::make($downloads['monthly']);
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
            '/dub/downloads-monthly/{package}',
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
            '/dub/downloads-monthly/vibe-d' => 'monthly downloads',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
