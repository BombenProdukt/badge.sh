<?php

declare(strict_types=1);

namespace App\Badges\Bit\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class TotalComponentsBadge extends AbstractBadge
{
    protected array $routes = [
        '/bit/components/{collection}',
    ];

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

    public function routeConstraints(Route $route): void
    {
        $route->where('collection', RoutePattern::CATCH_ALL->value);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'total components',
                path: '/bit/components/ramda/ramda',
                data: $this->render([]),
            ),
        ];
    }
}
