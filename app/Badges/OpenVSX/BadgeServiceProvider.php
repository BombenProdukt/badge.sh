<?php

declare(strict_types=1);

namespace App\Badges\OpenVSX;

use App\Facades\BadgeService;
use Illuminate\Support\ServiceProvider;

final class BadgeServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        BadgeService::add(Badges\DownloadsBadge::class);
        BadgeService::add(Badges\LicenseBadge::class);
        BadgeService::add(Badges\RatingBadge::class);
        BadgeService::add(Badges\ReleaseDateBadge::class);
        BadgeService::add(Badges\ReviewsBadge::class);
        BadgeService::add(Badges\VersionBadge::class);
    }
}
