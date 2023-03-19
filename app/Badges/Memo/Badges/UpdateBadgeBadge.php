<?php

declare(strict_types=1);

namespace App\Badges\Memo\Badges;

use App\Contracts\Badge;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Cache;

final class UpdateBadgeBadge implements Badge
{
    public function handle(Request $request, string $name): array
    {
        $badge = [
            'label'        => $request->input('label'),
            'message'      => $request->input('status'),
            'messageColor' => $request->input('statusColor'),
        ];

        Cache::rememberForever($name, $badge);

        return $badge;
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
        return [
            //
        ];
    }

    public function routePaths(): array
    {
        return [
            //
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
            //
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
