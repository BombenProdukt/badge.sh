<?php

declare(strict_types=1);

namespace App\Badges\LibrariesIO\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class RepositoryDependenciesBadge extends AbstractBadge
{
    protected string $route = '/libraries-io/repository-dependencies/{package:wildcard}';

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

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'dependencies',
                path: '/libraries-io/repository-dependencies/phoenixframework/phoenix',
                data: $this->render(['deprecatedCount' => 0, 'outdatedCount' => 0]),
            ),
            new BadgePreviewData(
                name: 'dependencies',
                path: '/libraries-io/repository-dependencies/phoenixframework/phoenix',
                data: $this->render(['deprecatedCount' => 5, 'outdatedCount' => 0]),
            ),
            new BadgePreviewData(
                name: 'dependencies',
                path: '/libraries-io/repository-dependencies/phoenixframework/phoenix',
                data: $this->render(['deprecatedCount' => 0, 'outdatedCount' => 5]),
            ),
        ];
    }
}
