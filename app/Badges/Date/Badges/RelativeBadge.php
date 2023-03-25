<?php

declare(strict_types=1);

namespace App\Badges\Date\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class RelativeBadge extends AbstractBadge
{
    /**
     * The routes to access this badge.
     *
     * @var array<int, string>
     */
    protected array $routes = [
        '/date/relative/{timestamp}',
    ];

    /**
     * The keywords that describe this badge.
     *
     * @var array<int, string>
     */
    protected array $keywords = [
        Category::OTHER,
    ];

    public function handle(string $timestamp): array
    {
        return [
            'timestamp' => $timestamp,
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderDateDiff('date', $properties['timestamp']);
    }

    public function routeConstraints(Route $route): void
    {
        $route->whereNumber('timestamp');
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/date/relative/1540814400' => 'relative date',
        ];
    }
}
