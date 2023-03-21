<?php

declare(strict_types=1);

namespace App\Badges\NPM\Badges;

use App\Badges\AbstractBadge;
use App\Badges\NPM\Client;
use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class TypesBadge extends AbstractBadge
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

    public function keywords(): array
    {
        return [Category::PLATFORM_SUPPORT];
    }

    public function routePaths(): array
    {
        return [
            '/npm/types/{package}/{tag?}',
        ];
    }

    public function routeParameters(): array
    {
        return [];
    }

    public function routeConstraints(Route $route): void
    {
        $route->where('package', RoutePattern::PACKAGE_WITH_SCOPE->value);
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/npm/types/tslib' => 'types',
            '/npm/types/react' => 'types',
            '/npm/types/queri' => 'types',
        ];
    }
}
