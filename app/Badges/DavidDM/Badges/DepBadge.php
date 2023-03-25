<?php

declare(strict_types=1);

namespace App\Badges\DavidDM\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class DepBadge extends AbstractBadge
{
    protected array $routes = [
        '/david/dep/{repo}/{path?}',
    ];

    protected array $keywords = [
        Category::DEPENDENCIES,
    ];

    protected array $deprecated = [
        '2023-03-18' => 'Deprecated due to the deprecation of required APIs.',
    ];

    public function handle(string $repo, string $path): array
    {
        return $this->client->get($repo, $path);
    }

    public function render(array $properties): array
    {
        return [
            'label' => 'dependencies',
            'message' => $this->statusInfo[$properties['status']][0],
            'messageColor' => $this->statusInfo[$properties['status']][1],
        ];
    }

    public function routeConstraints(Route $route): void
    {
        $route->where('repo', RoutePattern::CATCH_ALL->value);
        $route->where('path', RoutePattern::CATCH_ALL->value);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'dependencies',
                path: '/david/dep/zeit/pkg',
                data: $this->render([]),
            ),
            new BadgePreviewData(
                name: 'dependencies (sub path)',
                path: '/david/dep/babel/babel/packages/babel-cli',
                data: $this->render([]),
            ),
        ];
    }
}
