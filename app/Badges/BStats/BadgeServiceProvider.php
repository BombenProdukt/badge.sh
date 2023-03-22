<?php

declare(strict_types=1);

namespace App\Badges\BStats;

use App\Facades\BadgeService;
use Illuminate\Support\ServiceProvider;

final class BadgeServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        BadgeService::add(Badges\PlayersBadge::class);
        BadgeService::add(Badges\ServersBadge::class);
    }
}
