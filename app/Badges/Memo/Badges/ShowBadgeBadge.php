<?php

declare(strict_types=1);

namespace App\Badges\Memo\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Cache;

final class ShowBadgeBadge extends AbstractBadge
{
    /**
     * The routes to access this badge.
     *
     * @var array<int, string>
     */
    protected array $routes = [
        '/memo/{name}',
    ];

    /**
     * The keywords that describe this badge.
     *
     * @var array<int, string>
     */
    protected array $keywords = [
        Category::OTHER,
    ];

    public function handle(string $name): array
    {
        return Cache::get($name);
    }

    public function render(array $properties): array
    {
        //
    }

    public function routeParameters(): array
    {
        return [];
    }

    public function routeConstraints(Route $route): void
    {
        //
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/memo/deployed' => 'memoized badge for deploy status',
        ];
    }
}
