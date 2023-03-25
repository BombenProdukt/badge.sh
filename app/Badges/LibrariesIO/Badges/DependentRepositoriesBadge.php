<?php

declare(strict_types=1);

namespace App\Badges\LibrariesIO\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class DependentRepositoriesBadge extends AbstractBadge
{
    protected array $routes = [
        '/libraries-io/dependent-repositories/{platform}/{package}',
    ];

    protected array $keywords = [
        Category::DEPENDENCIES,
    ];

    public function handle(string $platform, string $package): array
    {
        return [
            'count' => $this->client->get($platform, $package)['dependent_repos_count'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('dependent repositories', $properties['count']);
    }

    public function routeConstraints(Route $route): void
    {
        $route->where('package', RoutePattern::CATCH_ALL->value);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'dependent repositories',
                path: '/libraries-io/dependent-repositories/npm/got',
                data: $this->render([]),
            ),
            new BadgePreviewData(
                name: 'dependent repositories (scoped)',
                path: '/libraries-io/dependent-repositories/npm/@babel/core',
                data: $this->render([]),
            ),
        ];
    }
}
