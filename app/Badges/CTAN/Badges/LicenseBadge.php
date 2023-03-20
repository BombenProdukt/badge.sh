<?php

declare(strict_types=1);

namespace App\Badges\CTAN\Badges;

use App\Badges\CTAN\Client;
use App\Badges\Templates\LicenseTemplate;
use App\Contracts\Badge;
use Illuminate\Routing\Route;

final class LicenseBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $package): array
    {
        return LicenseTemplate::make($this->client->api($package)['license']);
    }

    public function service(): string
    {
        return 'CTAN';
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
            '/ctan/{package}/license',
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
            '/ctan/latexdiff/license' => 'license',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}