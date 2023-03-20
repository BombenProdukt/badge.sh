<?php

declare(strict_types=1);

namespace App\Badges\Flathub\Badges;

use App\Badges\Flathub\Client;
use App\Badges\Templates\DownloadsTemplate;
use App\Contracts\Badge;
use Illuminate\Routing\Route;

final class DownloadsBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $packageName): array
    {
        return DownloadsTemplate::make($this->client->downloads($packageName));
    }

    public function service(): string
    {
        return 'Flathub';
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
            '/flathub/downloads/{packageName}',
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
            '/flathub/downloads/org.mozilla.firefox' => 'version',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
