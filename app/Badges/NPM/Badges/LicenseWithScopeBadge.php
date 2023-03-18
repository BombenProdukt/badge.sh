<?php

declare(strict_types=1);

namespace App\Badges\NPM\Badges;

use App\Badges\NPM\Client;
use App\Contracts\Badge;
use Illuminate\Routing\Route;

final class LicenseWithScopeBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $scope, string $package, string $tag = 'latest'): array
    {
        return [
            'label'       => 'license',
            'status'      => $this->client->unpkg("{$scope}/{$package}@{$tag}/package.json")['license'],
            'statusColor' => 'blue.600',
        ];
    }

    public function service(): string
    {
        return 'npm';
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
            '/npm/license/{scope}/{package}/{tag?}',
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
        $route->where('scope', '@[a-z]+');
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
            '/npm/license/lodash' => 'license',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
