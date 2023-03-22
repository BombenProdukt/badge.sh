<?php

declare(strict_types=1);

namespace App\Badges\PackageControl;

use App\Facades\BadgeService;
use Illuminate\Support\ServiceProvider;

final class BadgeServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        BadgeService::add(Badges\DownloadsBadge::class);
        BadgeService::add(Badges\DownloadsPerDayBadge::class);
        BadgeService::add(Badges\DownloadsPerLinuxBadge::class);
        BadgeService::add(Badges\DownloadsPerMacBadge::class);
        BadgeService::add(Badges\DownloadsPerMonthBadge::class);
        BadgeService::add(Badges\DownloadsPerWeekBadge::class);
        BadgeService::add(Badges\DownloadsPerWindowsBadge::class);
        BadgeService::add(Badges\LastModifiedBadge::class);
        BadgeService::add(Badges\PlatformsBadge::class);
        BadgeService::add(Badges\RankBadge::class);
        BadgeService::add(Badges\VersionBadge::class);
    }
}
