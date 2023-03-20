<?php

declare(strict_types=1);

namespace App\Badges\Fedora\Badges;

use App\Badges\Fedora\Client;
use App\Badges\Templates\VersionTemplate;
use App\Contracts\Badge;
use Illuminate\Routing\Route;

final class VersionBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $packageName, ?string $branch = 'rawhide'): array
    {
        return VersionTemplate::make($this->service(), $this->client->version($packageName, $branch));
    }

    public function service(): string
    {
        return 'Fedora';
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
            '/fedora/version/{packageName}/{branch?}',
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
            '/fedora/version/rpm'         => 'version',
            '/fedora/version/rpm/rawhide' => 'version',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
