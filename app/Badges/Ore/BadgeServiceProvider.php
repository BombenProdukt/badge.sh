<?php

declare(strict_types=1);

namespace App\Badges\Ore;

use App\Facades\BadgeService;
use Illuminate\Support\ServiceProvider;

final class BadgeServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        BadgeService::add(Badges\CategoryBadge::class);
        BadgeService::add(Badges\DownloadsBadge::class);
        BadgeService::add(Badges\LastModifiedBadge::class);
        BadgeService::add(Badges\LicenseBadge::class);
        BadgeService::add(Badges\SpongeVersionBadge::class);
        BadgeService::add(Badges\StarsBadge::class);
        BadgeService::add(Badges\VersionBadge::class);
        BadgeService::add(Badges\ViewsBadge::class);
        BadgeService::add(Badges\WatchersBadge::class);
    }
}
