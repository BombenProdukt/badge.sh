<?php

declare(strict_types=1);

namespace App\Badges\DavidDM\Badges;

use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class OptionalBadge extends AbstractBadge
{
    protected array $routes = [
        '/david/optional/{repo}/{path?}',
    ];

    protected array $keywords = [
        Category::DEPENDENCIES,
    ];

    protected array $deprecated = [
        '2023-03-18' => 'Deprecated due to the deprecation of required APIs.',
    ];

    public function handle(string $repo, string $path): array
    {
        return $this->client->get($repo, $path, 'optional-');
    }

    public function render(array $properties): array
    {
        return [
            'label' => 'optionalDependencies',
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
            '/david/optional/epoberezkin/ajv-keywords' => 'optional dependencies',
        ];
    }
}
