<?php

declare(strict_types=1);

namespace App\Badges\Bit\Badges;

use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class TotalComponentsBadge extends AbstractBadge
{
    /**
     * The routes to access this badge.
     *
     * @var array<int, string>
     */
    protected array $routes = [
        '/bit/components/{collection}',
    ];

    /**
     * The keywords that describe this badge.
     *
     * @var array<int, string>
     */
    protected array $keywords = [
        Category::SIZE,
    ];

    public function handle(string $collection): array
    {
        return [
            'count' => $this->client->get($collection)['totalComponents'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('components', $properties['count']);
    }

    public function routeParameters(): array
    {
        return [];
    }

    public function routeConstraints(Route $route): void
    {
        $route->where('collection', RoutePattern::CATCH_ALL->value);
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/bit/components/ramda/ramda' => 'total components',
        ];
    }
}
