<?php

declare(strict_types=1);

namespace App\Badges\NPM\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class TypesBadge extends AbstractBadge
{
    protected array $routes = [
        '/npm/types/{package}/{tag?}',
    ];

    protected array $keywords = [
        Category::PLATFORM_SUPPORT,
    ];

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
                'types' => $this->client->unpkg('@types/'.($package[0] === '@' ? \str_replace('/', '__', \mb_substr($package, 1)) : $package).'/package.json')['name'],
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
                'label' => 'types',
                'message' => 'missing',
                'messageColor' => 'orange.600',
            ];
        }

        if ($properties['types'] === 'included') {
            return [
                'label' => 'types',
                'message' => 'included',
                'messageColor' => '0074c1',
            ];
        }

        return [
            'label' => 'types',
            'message' => $properties['types'],
            'messageColor' => 'cyan.600',
        ];
    }

    public function routeConstraints(Route $route): void
    {
        $route->where('package', RoutePattern::PACKAGE_WITH_SCOPE->value);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'types',
                path: '/npm/types/tslib',
                data: $this->render(['types' => 'included']),
            ),
            new BadgePreviewData(
                name: 'types',
                path: '/npm/types/react',
                data: $this->render(['types' => '@types/react']),
            ),
            new BadgePreviewData(
                name: 'types',
                path: '/npm/types/queri',
                data: $this->render(['types' => 'missing']),
            ),
        ];
    }
}
