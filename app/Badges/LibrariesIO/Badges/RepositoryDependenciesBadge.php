<?php

declare(strict_types=1);

namespace App\Badges\LibrariesIO\Badges;

use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class RepositoryDependenciesBadge extends AbstractBadge
{
    public function handle(string $package): array
    {
        $dependencies = $this->client->github($package)['dependencies'];

        $deprecatedCount = collect($dependencies)->filter(fn ($dependency) => $dependency['deprecated'] === true)->count();
        if ($deprecatedCount > 0) {
            return $this->renderText('dependencies', $deprecatedCount.' deprecated', 'red.600');
        }

        $outdatedCount = collect($dependencies)->filter(fn ($dependency) => $dependency['outdated'] === true)->count();
        if ($outdatedCount > 0) {
            return $this->renderText('dependencies', $outdatedCount.' out of date', 'orange.600');
        }

        return $this->renderText('dependencies', 'up to date', 'green.600');
    }

    public function keywords(): array
    {
        return [Category::DEPENDENCIES];
    }

    public function routePaths(): array
    {
        return [
            '/libraries-io/repository-dependencies/{package}',
        ];
    }

    public function routeParameters(): array
    {
        return [];
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
