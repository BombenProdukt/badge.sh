<?php

declare(strict_types=1);

namespace App\Badges\Sourceforge;

use App\Facades\BadgeService;
use Illuminate\Support\ServiceProvider;

final class BadgeServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        BadgeService::add(Badges\DownloadsBadge::class);
        BadgeService::add(Badges\DownloadsPerDayBadge::class);
        BadgeService::add(Badges\DownloadsPerMonthBadge::class);
        BadgeService::add(Badges\DownloadsPerWeekBadge::class);
    }
}
