<?php

declare(strict_types=1);

namespace App\Badges\Cookbook\Badges;

use App\Badges\Cookbook\Client;
use App\Badges\Templates\VersionTemplate;
use App\Contracts\Badge;
use Illuminate\Routing\Route;

final class VersionBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $cookbook): array
    {
        return VersionTemplate::make($this->service(), $this->client->version($cookbook));
    }

    public function service(): string
    {
        return 'Cookbook';
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
            '/cookbook/version/{cookbook}',
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
            '/cookbook/version/chef-sugar' => 'version',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
