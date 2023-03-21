<?php

declare(strict_types=1);

namespace App\Badges\Gitter\Badges;

use App\Badges\Templates\TextTemplate;
use App\Contracts\Badge;
use Illuminate\Routing\Route;

final class StatusBadge implements Badge
{
    public function handle(string $org, string $room): array
    {
        return TextTemplate::make('gitter', 'on gitter', 'ed1965');
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
        return [
            //
        ];
    }

    public function routePaths(): array
    {
        return [
            '/gitter/status/{org}/{room}',
        ];
    }

    public function routeParameters(): array
    {
        return [
            //
        ];
    }

    public function routeConstraints(Route $route): void
    {
        //
    }

    public function staticPreviews(): array
    {
        return [
            //
        ];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/gitter/status/redom/lobby' => 'status',
            '/gitter/status/redom/redom' => 'status',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
