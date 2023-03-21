<?php

declare(strict_types=1);

namespace App\Badges;

use App\Badges\Concerns\HasRequest;
use App\Badges\Concerns\HasTemplates;
use App\Contracts\Badge;
use Illuminate\Routing\Route;

abstract class AbstractBadge implements Badge
{
    use HasRequest;
    use HasTemplates;

    public function service(): string
    {
        return '';
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
        return [];
    }

    public function routeRules(): array
    {
        return [];
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
        return [];
    }

    public function deprecated(): array
    {
        return [];
    }
}
