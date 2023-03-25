<?php

declare(strict_types=1);

namespace App\Badges\Maintenance\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;
use Illuminate\Routing\Route;

final class MaintainedBadge extends AbstractBadge
{
    protected array $routes = [
        '/maintenance/maintained/{year}',
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
        return $this->renderText('maintained', $properties['year'], 'green.600');
    }

    public function routeConstraints(Route $route): void
    {
        $route->whereNumber('year');
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'maintained',
                path: '/maintenance/maintained/2023',
                data: $this->render(['year' => 2023]),
            ),
        ];
    }
}
