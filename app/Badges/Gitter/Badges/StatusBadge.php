<?php

declare(strict_types=1);

namespace App\Badges\Gitter\Badges;

use App\Badges\AbstractBadge;
use App\Enums\Category;
use Illuminate\Routing\Route;

final class StatusBadge extends AbstractBadge
{
    public function handle(string $org, string $room): array
    {
        return $this->renderText('gitter', 'on gitter', 'ed1965');
    }

    public function service(): string
    {
        return 'Gitter';
    }

    public function title(): string
    {
        return '';
    }

    public function keywords(): array
    {
        return [Category::SOCIAL];
    }

    public function routePaths(): array
    {
        return [
            '/gitter/status/{org}/{room}',
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
            '/gitter/status/redom/lobby' => 'status',
            '/gitter/status/redom/redom' => 'status',
        ];
    }
}
