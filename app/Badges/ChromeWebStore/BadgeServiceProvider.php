<?php

declare(strict_types=1);

namespace App\Badges\ChromeWebStore;

use App\Facades\BadgeService;
use Illuminate\Support\ServiceProvider;

final class BadgeServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        BadgeService::add(Badges\VersionBadge::class);
        BadgeService::add(Badges\UsersBadge::class);
        BadgeService::add(Badges\PriceBadge::class);
        BadgeService::add(Badges\StarsBadge::class);
        BadgeService::add(Badges\RatingBadge::class);
        BadgeService::add(Badges\RatingCountBadge::class);
    }
}
