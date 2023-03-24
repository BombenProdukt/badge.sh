<?php

declare(strict_types=1);

namespace App\Badges\Maintenance\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class MaintainedBadge extends AbstractBadge
{
    public function handle(string $year): array
    {
        return $this->renderText('maintained', $year, 'green.600');
    }

    public function keywords(): array
    {
        return [Category::ACTIVITY];
    }

    public function routePaths(): array
    {
        return [
            '/maintenance/maintained/{year}',
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
            '/maintenance/maintained/2023' => 'maintained',
        ];
    }
}
