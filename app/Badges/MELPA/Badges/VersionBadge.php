<?php

declare(strict_types=1);

namespace App\Badges\MELPA\Badges;

use App\Badges\MELPA\Client;
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
        preg_match('/<title>([^<]+)<\//i', $this->client->get($package), $matches);

        [, $version] = explode(':', trim($matches[1]));

        return VersionTemplate::make($this->service(), $version);
    }

    public function service(): string
    {
        return 'MELPA';
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
            '/melpa/version/{package}',
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
            '/melpa/version/magit' => 'version',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
