<?php

declare(strict_types=1);

namespace App\Badges\NPM\Badges;

use App\Badges\NPM\Client;
use App\Contracts\Badge;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class TypesBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $package, string $tag = 'latest'): array
    {
        $response = $this->client->unpkg("{$package}@{$tag}/package.json");

        if (isset($response['types']) || isset($response['typings']) || isset($response['exports']['types'])) {
            return [
                'label'        => 'types',
                'message'      => 'included',
                'messageColor' => '0074c1',
            ];
        }

        try {
            $this->client->unpkg("{$package}/index.d.ts");

            return [
                'label'        => 'types',
                'message'      => 'included',
                'messageColor' => '0074c1',
            ];
        } catch (\Throwable) {
            //
        }

        try {
            return [
                'label'        => 'types',
                'message'      => $this->client->unpkg('@types/'.($package[0] === '@' ? str_replace('/', '__', substr($package, 1)) : $package).'/package.json')['name'],
                'messageColor' => 'cyan.600',
            ];
        } catch (\Throwable) {
            //
        }

        return [
            'label'        => 'types',
            'message'      => 'missing',
            'messageColor' => 'orange.600',
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
            '/npm/{package}/types/{tag?}',
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
        $route->where('package', RoutePattern::PACKAGE_WITH_SCOPE->value);
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
            '/npm/tslib/types' => 'types',
            '/npm/react/types' => 'types',
            '/npm/queri/types' => 'types',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
