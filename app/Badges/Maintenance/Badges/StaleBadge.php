<?php

declare(strict_types=1);

namespace App\Badges\Maintenance\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class StaleBadge extends AbstractBadge
{
    /**
     * The routes to access this badge.
     *
     * @var array<int, string>
     */
    protected array $routes = [
        '/maintenance/stale/{year}',
    ];

    /**
     * The keywords that describe this badge.
     *
     * @var array<int, string>
     */
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

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/maintenance/stale/2023' => 'stale',
        ];
    }
}
