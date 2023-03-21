<?php

declare(strict_types=1);

namespace App\Badges\WinGet\Badges;

use App\Badges\Templates\VersionTemplate;
use App\Badges\WinGet\Client;
use App\Contracts\Badge;
use Illuminate\Routing\Route;

final class VersionBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $appId): array
    {
        return VersionTemplate::make($this->service(), $this->client->version($appId));
    }

    public function service(): string
    {
        return 'winget';
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
            '/winget/version/{appId}',
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
            '/winget/version/GitHub.cli'    => 'version',
            '/winget/version/Balena.Etcher' => 'version',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
