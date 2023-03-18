<?php

declare(strict_types=1);

namespace App\Badges\DUB;

use App\Facades\BadgeService;
use Illuminate\Support\ServiceProvider;

final class BadgeServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        BadgeService::add(Badges\VersionBadge::class);
        BadgeService::add(Badges\VersionBadge::class);
        BadgeService::add(Badges\LicenseBadge::class);
        BadgeService::add(Badges\DailyDownloadsBadge::class);
        BadgeService::add(Badges\WeeklyDownloadsBadge::class);
        BadgeService::add(Badges\MonthlyDownloadsBadge::class);
        BadgeService::add(Badges\TotalDownloadsBadge::class);
        BadgeService::add(Badges\RatingBadge::class);
        BadgeService::add(Badges\StarsBadge::class);
    }
}
