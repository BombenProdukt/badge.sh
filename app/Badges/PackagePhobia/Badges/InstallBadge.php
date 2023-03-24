<?php

declare(strict_types=1);

namespace App\Badges\PackagePhobia\Badges;

use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class InstallBadge extends AbstractBadge
{
    public function handle(string $name): array
    {
        $response = $this->client->get($name);

        return [
            'size'  => $response['install']['pretty'],
            'color' => $response['install']['color'],
        ];
    }

    public function render(array $properties): array
    {
        return [
            'label'        => 'install size',
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
            '/packagephobia/size/{name}',
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
            '/packagephobia/size/webpack'               => 'install size',
            '/packagephobia/size/@tusbar/cache-control' => 'install size',
        ];
    }
}
