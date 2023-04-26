<?php

declare(strict_types=1);

namespace App\Badges\LibrariesIO;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class ProjectDependenciesBadge extends AbstractBadge
{
    protected string $route = '/libraries-io/project-dependencies/{platform}/{package:wildcard}/{version?}';

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

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'dependencies',
                path: '/libraries-io/project-dependencies/npm/got',
                data: $this->render(['deprecatedCount' => 1, 'outdatedCount' => 0]),
            ),
            new BadgePreviewData(
                name: 'dependencies (release)',
                path: '/libraries-io/project-dependencies/npm/got/1.0.0',
                data: $this->render(['deprecatedCount' => 1, 'outdatedCount' => 0]),
            ),
            new BadgePreviewData(
                name: 'dependencies (scoped)',
                path: '/libraries-io/project-dependencies/npm/@babel/core',
                data: $this->render(['deprecatedCount' => 0, 'outdatedCount' => 1]),
            ),
            new BadgePreviewData(
                name: 'dependencies (scoped, release)',
                path: '/libraries-io/project-dependencies/npm/@babel/core/7.0.0',
                data: $this->render(['deprecatedCount' => 0, 'outdatedCount' => 1]),
            ),
        ];
    }
}
