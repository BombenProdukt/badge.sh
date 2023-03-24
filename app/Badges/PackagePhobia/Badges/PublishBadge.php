<?php

declare(strict_types=1);

namespace App\Badges\PackagePhobia\Badges;

use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class PublishBadge extends AbstractBadge
{
    public function handle(string $name): array
    {
        $response = $this->client->get($name);

        return [
            'size'  => $response['publish']['pretty'],
            'color' => $response['publish']['color'],
        ];
    }

    public function render(array $properties): array
    {
        return [
            'label'        => 'publish size',
            'message'      => $properties['size'],
            'messageColor' => str_replace('#', '', $properties['color']),
        ];
    }

    public function keywords(): array
    {
        return [Category::SIZE];
    }

    public function routePaths(): array
    {
        return [
            '/packagephobia/publish/{name}',
        ];
    }

    public function routeParameters(): array
    {
        return [];
    }

    public function routeConstraints(Route $route): void
    {
        $route->where('name', RoutePattern::CATCH_ALL->value);
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/packagephobia/publish/webpack'               => 'publish size',
            '/packagephobia/publish/@tusbar/cache-control' => '(scoped pkg) publish size',
        ];
    }
}
