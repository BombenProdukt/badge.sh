<?php

declare(strict_types=1);

namespace App\Badges\LibrariesIO\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class SourceRankBadge extends AbstractBadge
{
    protected array $routes = [
        '/libraries-io/sourcerank/{platform}/{package}',
    ];

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

    public function routeConstraints(Route $route): void
    {
        $route->where('package', RoutePattern::CATCH_ALL->value);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'sourcerank',
                path: '/libraries-io/sourcerank/npm/got',
                data: $this->render(['rank' => 1]),
            ),
            new BadgePreviewData(
                name: 'sourcerank (scoped)',
                path: '/libraries-io/sourcerank/npm/@babel/core',
                data: $this->render(['rank' => 1]),
            ),
        ];
    }
}
