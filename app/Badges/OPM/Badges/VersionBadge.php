<?php

declare(strict_types=1);

namespace App\Badges\OPM\Badges;

use App\Badges\OPM\Client;
use App\Badges\Templates\VersionTemplate;
use App\Contracts\Badge;
use Illuminate\Routing\Route;

final class VersionBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $appId): array
    {
        $version = $this->client->get($appId)['CurrentVersion'];

        return VersionTemplate::make($this->service(), $version);
    }

    public function service(): string
    {
        return 'WIP';
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
            '/f-droid/{appId}/version',
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
            '/opm/version/openresty/lua-resty-lrucache' => 'version',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
