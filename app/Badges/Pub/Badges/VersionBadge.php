<?php

declare(strict_types=1);

namespace App\Badges\Pub\Badges;

use App\Badges\Pub\Client;
use App\Badges\Templates\VersionTemplate;
use App\Contracts\Badge;
use Illuminate\Routing\Route;

final class VersionBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $package): array
    {
        $version = $this->client->api("packages/{$package}")['latest']['version'];

        return VersionTemplate::make($this->service(), $version);
    }

    public function service(): string
    {
        return 'Pub';
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
            '/pub/version/{package}',
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
            '/pub/version/kt_dart' => 'version',
            '/pub/version/mobx'    => 'version',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
