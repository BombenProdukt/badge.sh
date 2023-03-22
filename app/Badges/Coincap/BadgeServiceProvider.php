<?php

declare(strict_types=1);

namespace App\Badges\Coincap;

use App\Facades\BadgeService;
use Illuminate\Support\ServiceProvider;

final class BadgeServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        BadgeService::add(Badges\LastDayPriceChangeBadge::class);
        BadgeService::add(Badges\PriceBadge::class);
        BadgeService::add(Badges\RankBadge::class);
    }
}
