<?php

declare(strict_types=1);

namespace App\Badges\HexPM\Badges;

use App\Badges\HexPM\Client;
use App\Badges\Templates\DownloadsTemplate;
use App\Contracts\Badge;
use Illuminate\Routing\Route;

final class DownloadsPerWeekBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $packageName): array
    {
        return DownloadsTemplate::make($this->client->get($packageName)['downloads']['week']);
    }

    public function service(): string
    {
        return 'hex.pm';
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
            '/hex/downloads-weekly/{packageName}',
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
            '/hex/downloads-weekly/plug' => 'total downloads',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
