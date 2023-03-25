<?php

declare(strict_types=1);

namespace App\Badges\LibrariesIO\Badges;

use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class SourceRankBadge extends AbstractBadge
{
    /**
     * The routes to access this badge.
     *
     * @var array<int, string>
     */
    protected array $routes = [
        '/libraries-io/sourcerank/{platform}/{package}',
    ];

    /**
     * The keywords that describe this badge.
     *
     * @var array<int, string>
     */
    protected array $keywords = [
        Category::ANALYSIS,
    ];

    public function handle(string $platform, string $package): array
    {
        return $this->client->get($platform, $package);
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('sourcerank', $properties['rank']);
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
            '/libraries-io/sourcerank/npm/got' => 'sourcerank',
            '/libraries-io/sourcerank/npm/@babel/core' => 'sourcerank (scoped)',
        ];
    }
}
