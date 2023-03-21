<?php

declare(strict_types=1);

namespace App\Badges\OPM\Badges;

use App\Badges\OPM\Client;
use App\Badges\Templates\VersionTemplate;
use App\Contracts\Badge;
use Illuminate\Routing\Route;
use Spatie\Regex\Regex;

final class VersionBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $user, string $moduleName): array
    {
        return VersionTemplate::make($this->service(), Regex::match("/{$moduleName}-(.+).opm/", $this->client->version($user, $moduleName))->group(1));
    }

    public function service(): string
    {
        return 'OPM';
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
            '/opm/version/{user}/{moduleName}',
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
