<?php

declare(strict_types=1);

namespace App\Badges\Maintenance\Badges;

use App\Badges\AbstractBadge;
use App\Enums\Category;
use Illuminate\Routing\Route;

final class AbandonedBadge extends AbstractBadge
{
    public function handle(string $year): array
    {
        return $this->renderText('abandoned', $year, 'red.600');
    }

    public function service(): string
    {
        return 'Maintenance';
    }

    public function keywords(): array
    {
        return [Category::ACTIVITY];
    }

    public function routePaths(): array
    {
        return [
            '/maintenance/abandoned/{year}',
        ];
    }

    public function routeParameters(): array
    {
        return [];
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
            '/maintenance/abandoned/2023' => 'abandoned',
        ];
    }
}
