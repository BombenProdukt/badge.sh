<?php

declare(strict_types=1);

namespace App\Badges\OpenVSX\Badges;

use App\Badges\OpenVSX\Client;
use App\Badges\Templates\VersionTemplate;
use App\Contracts\Badge;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class VersionBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $extension): array
    {
        $response = $this->client->get($extension);

        return VersionTemplate::make($this->service(), $response['version']);
    }

    public function service(): string
    {
        return 'Open VSX';
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
            '/open-vsx/version/{extension}',
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
        $route->where('extension', RoutePattern::CATCH_ALL->value);
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
            '/open-vsx/version/idleberg/electron-builder' => 'version',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
