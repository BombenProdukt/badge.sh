<?php

declare(strict_types=1);

namespace App\Badges\AUR\Badges;

use App\Badges\AUR\Client;
use App\Badges\Templates\LicenseTemplate;
use App\Contracts\Badge;
use Illuminate\Routing\Route;

final class MaintainerBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $package): array
    {
        return LicenseTemplate::make($this->client->get($package)['Maintainer']);
    }

    public function service(): string
    {
        return 'AUR';
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
            '/aur/maintainer/{package}',
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
            '/aur/maintainer/google-chrome' => 'maintainer',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
