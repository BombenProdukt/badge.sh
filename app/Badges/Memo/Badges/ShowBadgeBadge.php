<?php

declare(strict_types=1);

namespace App\Badges\Memo\Badges;

use App\Badges\AbstractBadge;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Cache;

final class ShowBadgeBadge extends AbstractBadge
{
    public function handle(string $name): array
    {
        return Cache::get($name);
    }

    public function service(): string
    {
        return 'Memo';
    }

    public function title(): string
    {
        return '';
    }

    public function keywords(): array
    {
        return [];
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
