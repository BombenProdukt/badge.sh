<?php

declare(strict_types=1);

namespace App\Badges\WAPM\Badges;

use App\Badges\Templates\VersionTemplate;
use App\Badges\WAPM\Client;
use App\Contracts\Badge;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class VersionBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $package): array
    {
        $response = $this->client->get($package);

        return VersionTemplate::make($this->service(), $response['version']);
    }

    public function service(): string
    {
        return 'WAPM';
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
            '/wapm/version/{package}',
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
        $route->where('package', RoutePattern::CATCH_ALL->value);
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
            '/wapm/version/zamfofex/greg' => 'version',
            '/wapm/version/cowsay'        => 'version',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
