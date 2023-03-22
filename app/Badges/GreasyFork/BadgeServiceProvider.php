<?php

declare(strict_types=1);

namespace App\Badges\GreasyFork;

use App\Facades\BadgeService;
use Illuminate\Support\ServiceProvider;

final class BadgeServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        BadgeService::add(Badges\DailyDownloadsBadge::class);
        BadgeService::add(Badges\DownloadsBadge::class);
        BadgeService::add(Badges\LicenseBadge::class);
        BadgeService::add(Badges\RatingBadge::class);
        BadgeService::add(Badges\VersionBadge::class);
    }
}
