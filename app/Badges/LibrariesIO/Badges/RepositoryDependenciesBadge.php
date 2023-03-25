<?php

declare(strict_types=1);

namespace App\Badges\LibrariesIO\Badges;

use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class RepositoryDependenciesBadge extends AbstractBadge
{
    /**
     * The routes to access this badge.
     *
     * @var array<int, string>
     */
    protected array $routes = [
        '/libraries-io/repository-dependencies/{package}',
    ];

    /**
     * The keywords that describe this badge.
     *
     * @var array<int, string>
     */
    protected array $keywords = [
        Category::DEPENDENCIES,
    ];

    public function handle(string $package): array
    {
        $dependencies = $this->client->github($package)['dependencies'];

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

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/libraries-io/repository-dependencies/phoenixframework/phoenix' => 'dependencies',
        ];
    }
}
