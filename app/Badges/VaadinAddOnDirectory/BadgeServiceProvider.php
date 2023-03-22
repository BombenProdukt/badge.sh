<?php

declare(strict_types=1);

namespace App\Badges\VaadinAddOnDirectory;

use App\Facades\BadgeService;
use Illuminate\Support\ServiceProvider;

final class BadgeServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        BadgeService::add(Badges\RatingBadge::class);
        BadgeService::add(Badges\RatingCountBadge::class);
        BadgeService::add(Badges\ReleaseDateBadge::class);
        BadgeService::add(Badges\StarsBadge::class);
        BadgeService::add(Badges\StatusBadge::class);
        BadgeService::add(Badges\VersionBadge::class);
    }
}
