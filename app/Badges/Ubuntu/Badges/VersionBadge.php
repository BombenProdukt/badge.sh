<?php

declare(strict_types=1);

namespace App\Badges\Ubuntu\Badges;

use App\Badges\Templates\VersionTemplate;
use App\Badges\Ubuntu\Client;
use App\Contracts\Badge;
use Illuminate\Routing\Route;

final class VersionBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $packageName, ?string $series = null): array
    {
        return VersionTemplate::make($this->service(), $this->client->version($packageName, $series));
    }

    public function service(): string
    {
        return 'Ubuntu';
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
            '/ubuntu/version/{packageName}/{series?}',
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
            '/ubuntu/version/ubuntu-wallpapers'        => 'version',
            '/ubuntu/version/ubuntu-wallpapers/bionic' => 'version',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
