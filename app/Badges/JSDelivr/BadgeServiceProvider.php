<?php

declare(strict_types=1);

namespace App\Badges\JSDelivr;

use App\Facades\BadgeService;
use Illuminate\Support\ServiceProvider;

final class BadgeServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        BadgeService::add(Badges\HitsBadge::class);
        BadgeService::add(Badges\RankBadge::class);
        BadgeService::add(Badges\VersionBadge::class);
    }
}
