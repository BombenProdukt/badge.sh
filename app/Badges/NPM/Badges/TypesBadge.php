<?php

declare(strict_types=1);

namespace App\Badges\NPM\Badges;

use App\Badges\NPM\Client;
use App\Contracts\Badge;
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
                'label'       => 'types',
                'status'      => 'included',
                'statusColor' => '0074c1',
            ];
        }

        try {
            $this->client->unpkg("{$package}/index.d.ts");

            return [
                'label'       => 'types',
                'status'      => 'included',
                'statusColor' => '0074c1',
            ];
        } catch (\Throwable) {
            //
        }

        try {
            return [
                'label'       => 'types',
                'status'      => $this->client->unpkg('@types/'.($package[0] === '@' ? str_replace('/', '__', substr($package, 1)) : $package).'/package.json')['name'],
                'statusColor' => 'cyan.600',
            ];
        } catch (\Throwable) {
            //
        }

        return [
            'label'       => 'types',
            'status'      => 'missing',
            'statusColor' => 'orange.600',
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
            '/npm/types/{package}/{tag?}',
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
            '/npm/types/tslib' => 'types',
            '/npm/types/react' => 'types',
            '/npm/types/queri' => 'types',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
