<?php

declare(strict_types=1);

namespace App\Badges\Maintenance\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;
use Illuminate\Routing\Route;

final class StaleBadge extends AbstractBadge
{
    protected array $routes = [
        '/maintenance/stale/{year}',
    ];

    protected array $keywords = [
        Category::ACTIVITY,
    ];

    public function handle(string $year): array
    {
        return [
            'year' => $year,
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderText('stale', $properties['year'], 'blue.600');
    }

    public function routeConstraints(Route $route): void
    {
        $route->whereNumber('year');
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'stale',
                path: '/maintenance/stale/2023',
                data: $this->render([]),
            ),
        ];
    }
}
