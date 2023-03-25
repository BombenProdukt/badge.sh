<?php

declare(strict_types=1);

namespace App\Badges\LibrariesIO\Badges;

use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class ProjectDependenciesBadge extends AbstractBadge
{
    protected array $routes = [
        '/libraries-io/project-dependencies/{platform}/{package}/{version?}',
    ];

    protected array $keywords = [
        Category::DEPENDENCIES,
    ];

    public function handle(string $platform, string $package, string $version = 'latest'): array
    {
        $dependencies = $this->client->dependencies($platform, $package, $version)['dependencies'];

        return [
            'deprecatedCount' => collect($dependencies)->filter(fn ($dependency) => $dependency['deprecated'] === true)->count(),
            'outdatedCount' => collect($dependencies)->filter(fn ($dependency) => $dependency['outdated'] === true)->count(),
        ];
    }

    public function render(array $properties): array
    {
        if ($properties['deprecatedCount'] > 0) {
            return $this->renderText('dependencies', $properties['deprecatedCount'].' deprecated', 'red.600');
        }

        if ($properties['outdatedCount'] > 0) {
            return $this->renderText('dependencies', $properties['outdatedCount'].' out of date', 'orange.600');
        }

        return $this->renderText('dependencies', 'up to date', 'green.600');
    }

    public function routeConstraints(Route $route): void
    {
        $route->where('package', RoutePattern::CATCH_ALL->value);
    }

    public function previews(): array
    {
        return [
            '/libraries-io/project-dependencies/npm/got' => 'dependencies',
            '/libraries-io/project-dependencies/npm/got/1.0.0' => 'dependencies (release)',
            '/libraries-io/project-dependencies/npm/@babel/core' => 'dependencies (scoped)',
            '/libraries-io/project-dependencies/npm/@babel/core/7.0.0' => 'dependencies (scoped, release)',
        ];
    }
}
