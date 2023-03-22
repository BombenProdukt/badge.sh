<?php

declare(strict_types=1);

namespace App\Badges\WordPress;

use App\Facades\BadgeService;
use Illuminate\Support\ServiceProvider;

final class BadgeServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        BadgeService::add(Badges\AuthorBadge::class);
        BadgeService::add(Badges\CommercialBadge::class);
        BadgeService::add(Badges\CommunityBadge::class);
        BadgeService::add(Badges\DownloadsBadge::class);
        BadgeService::add(Badges\DownloadsPerDayBadge::class);
        BadgeService::add(Badges\DownloadsPerMonthBadge::class);
        BadgeService::add(Badges\DownloadsPerQuarter::class);
        BadgeService::add(Badges\DownloadsPerWeekBadge::class);
        BadgeService::add(Badges\DownloadsPerYearBadge::class);
        BadgeService::add(Badges\InstallationsBadge::class);
        BadgeService::add(Badges\LastModifiedBadge::class);
        BadgeService::add(Badges\NameBadge::class);
        BadgeService::add(Badges\PhpVersionBadge::class);
        BadgeService::add(Badges\RatingBadge::class);
        BadgeService::add(Badges\RatingsBadge::class);
        BadgeService::add(Badges\VersionBadge::class);
        BadgeService::add(Badges\WordPressVersionBadge::class);
    }
}
