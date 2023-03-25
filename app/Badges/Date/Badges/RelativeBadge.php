<?php

declare(strict_types=1);

namespace App\Badges\Date\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;
use Illuminate\Routing\Route;

final class RelativeBadge extends AbstractBadge
{
    protected array $routes = [
        '/date/relative/{timestamp}',
    ];

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

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'relative date',
                path: '/date/relative/1540814400',
                data: $this->render([]),
            ),
        ];
    }
}
