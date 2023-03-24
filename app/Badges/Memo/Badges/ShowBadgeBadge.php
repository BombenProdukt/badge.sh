<?php

declare(strict_types=1);

namespace App\Badges\Memo\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Cache;

final class ShowBadgeBadge extends AbstractBadge
{
    public function handle(string $name): array
    {
        return Cache::get($name);
    }

    public function keywords(): array
    {
        return [Category::OTHER];
    }

    public function routePaths(): array
    {
        return [
            '/memo/{name}',
        ];
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
