<?php

declare(strict_types=1);

namespace App\Badges\NPM\Badges;

use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class TypesBadge extends AbstractBadge
{
    public function handle(string $package, string $tag = 'latest'): array
    {
        $response = $this->client->unpkg("{$package}@{$tag}/package.json");

        if (isset($response['types']) || isset($response['typings']) || isset($response['exports']['types'])) {
            return [
                'types' => 'included',
            ];
        }

        try {
            $this->client->unpkg("{$package}/index.d.ts");

            return [
                'types' => 'included',
            ];
        } catch (\Throwable) {
            //
        }

        try {
            return [
                'types' => $this->client->unpkg('@types/'.($package[0] === '@' ? str_replace('/', '__', substr($package, 1)) : $package).'/package.json')['name'],
            ];
        } catch (\Throwable) {
            //
        }

        return [
            'types' => 'missing',
        ];
    }

    public function render(array $properties): array
    {
        if ($properties['types'] === 'missing') {
            return [
                'label'        => 'types',
                'message'      => 'missing',
                'messageColor' => 'orange.600',
            ];
        }

        if ($properties['types'] === 'included') {
            return [
                'label'        => 'types',
                'message'      => 'included',
                'messageColor' => '0074c1',
            ];
        }

        return [
            'label'        => 'types',
            'message'      => $properties['types'],
            'messageColor' => 'cyan.600',
        ];
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
