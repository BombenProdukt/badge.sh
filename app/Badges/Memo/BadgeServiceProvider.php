<?php

declare(strict_types=1);

namespace App\Badges\Memo;

use App\Facades\BadgeService;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

final class BadgeServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        BadgeService::add(Badges\ShowBadgeBadge::class);

        Route::put('/memo/{name}', Badges\UpdateBadgeBadge::class);
    }
}
