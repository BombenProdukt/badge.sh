<?php

declare(strict_types=1);

namespace App\Badges\DavidDM\Badges;

use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class DevBadge extends AbstractBadge
{
    public function handle(string $repo, string $path): array
    {
        return $this->client->get($repo, $path, 'dev-');
    }

    public function render(array $properties): array
    {
        return [
            'label'        => 'devDependencies',
            'message'      => $this->statusInfo[$properties['status']][0],
            'messageColor' => $this->statusInfo[$properties['status']][1],
        ];
    }

    public function keywords(): array
    {
        return [Category::DEPENDENCIES];
    }

    public function routePaths(): array
    {
        return [
            '/david/dev/{repo}/{path?}',
        ];
    }

    public function routeParameters(): array
    {
        return [];
    }

    public function routeConstraints(Route $route): void
    {
        $route->where('repo', RoutePattern::CATCH_ALL->value);
        $route->where('path', RoutePattern::CATCH_ALL->value);
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/david/dev/zeit/pkg' => 'dev dependencies',
        ];
    }

    public function deprecated(): array
    {
        return [
            '2023-03-18' => 'Deprecated due to the deprecation of required APIs.',
        ];
    }
}
