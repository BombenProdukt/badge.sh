<?php

declare(strict_types=1);

namespace App\Badges\NPM;

use App\Facades\BadgeService;
use Illuminate\Support\ServiceProvider;

final class BadgeServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // BadgeService::add(Badges\DailyDownloadsBadge::class);
        // BadgeService::add(Badges\DependentsBadge::class);
        // BadgeService::add(Badges\LicenseBadge::class);
        // BadgeService::add(Badges\MonthlyDownloadsBadge::class);
        // BadgeService::add(Badges\NodeBadge::class);
        // BadgeService::add(Badges\TotalDownloadsBadge::class);
        // BadgeService::add(Badges\TypesBadge::class);
        BadgeService::add(Badges\VersionBadge::class);
        // BadgeService::add(Badges\WeeklyDownloadsBadge::class);
        // BadgeService::add(Badges\YearlyDownloadsBadge::class);
    }
}
