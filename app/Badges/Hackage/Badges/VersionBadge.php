<?php

declare(strict_types=1);

namespace App\Badges\Hackage\Badges;

use App\Badges\Hackage\Client;
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
        $version = $this->client->hackage($package)['version'];

        return VersionTemplate::make($this->service(), $version);
    }

    public function service(): string
    {
        return 'Hackage';
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
            '/hackage/version/{package}',
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
            '/hackage/version/abt'   => 'version',
            '/hackage/version/Cabal' => 'version',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
