<?php

declare(strict_types=1);

namespace App\Badges\AppleMusic\Badges;

use App\Badges\AppleMusic\Client;
use App\Badges\Templates\VersionTemplate;
use App\Contracts\Badge;
use Illuminate\Routing\Route;

final class VersionBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $bundleId): array
    {
        return VersionTemplate::make($this->service(), $this->client->version($bundleId));
    }

    public function service(): string
    {
        return 'Apple Music';
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
            '/apple-music/version/{bundleId}',
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
            '/apple-music/version/803453959' => 'version',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
