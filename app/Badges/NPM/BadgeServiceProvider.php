<?php

declare(strict_types=1);

namespace App\Badges\NPM;

use App\Facades\BadgeService;
use Illuminate\Support\ServiceProvider;

final class BadgeServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        BadgeService::add(Badges\VersionWithScopeBadge::class);
        BadgeService::add(Badges\VersionBadge::class);

        BadgeService::add(Badges\LicenseWithScopeBadge::class);
        BadgeService::add(Badges\LicenseBadge::class);

        BadgeService::add(Badges\NodeWithScopeBadge::class);
        BadgeService::add(Badges\NodeBadge::class);

        BadgeService::add(Badges\TotalDownloadsWithScopeBadge::class);
        BadgeService::add(Badges\TotalDownloadsBadge::class);

        BadgeService::add(Badges\DailyDownloadsWithScopeBadge::class);
        BadgeService::add(Badges\DailyDownloadsBadge::class);

        BadgeService::add(Badges\WeeklyDownloadsWithScopeBadge::class);
        BadgeService::add(Badges\WeeklyDownloadsBadge::class);

        BadgeService::add(Badges\MonthlyDownloadsWithScopeBadge::class);
        BadgeService::add(Badges\MonthlyDownloadsBadge::class);

        BadgeService::add(Badges\YearlyDownloadsWithScopeBadge::class);
        BadgeService::add(Badges\YearlyDownloadsBadge::class);

        BadgeService::add(Badges\DependentsWithScopeBadge::class);
        BadgeService::add(Badges\DependentsBadge::class);

        BadgeService::add(Badges\TypesWithScopeBadge::class);
        BadgeService::add(Badges\TypesBadge::class);
    }
}
