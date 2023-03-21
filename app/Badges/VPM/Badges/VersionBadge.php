<?php

declare(strict_types=1);

namespace App\Badges\VPM\Badges;

use App\Badges\AbstractBadge;
use App\Badges\Templates\VersionTemplate;
use App\Badges\VPM\Client;
use Illuminate\Routing\Route;

final class VersionBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $packageId): array
    {
        return VersionTemplate::make($this->service(), array_key_last($this->client->versions($packageId)));
    }

    public function service(): string
    {
        return 'VPM';
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
            '/vpm/version/{packageId}',
        ];
    }

    public function routeParameters(): array
    {
        return [];
    }

    public function routeConstraints(Route $route): void
    {
        //
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/vpm/version/com.vrchat.udonsharp' => 'version',
        ];
    }
}
