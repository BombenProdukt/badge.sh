<?php

declare(strict_types=1);

namespace App\Badges\Homebrew;

use App\Facades\BadgeService;
use Illuminate\Support\ServiceProvider;

final class BadgeServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        BadgeService::add(Badges\DownloadsPerMonthBadge::class);
        BadgeService::add(Badges\DownloadsPerYearBadge::class);
        BadgeService::add(Badges\VersionBadge::class);
    }
}
