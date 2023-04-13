<?php

declare(strict_types=1);

namespace App\Badges\Pub;

use App\Facades\BadgeService;
use Illuminate\Support\ServiceProvider;

final class BadgeServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        BadgeService::add(Badges\DartPlatformBadge::class);
        BadgeService::add(Badges\FlutterPlatformBadge::class);
        BadgeService::add(Badges\LicenseBadge::class);
        BadgeService::add(Badges\LikesBadge::class);
        BadgeService::add(Badges\PointsBadge::class);
        BadgeService::add(Badges\PopularityBadge::class);
        BadgeService::add(Badges\SdkVersionBadge::class);
        BadgeService::add(Badges\VersionBadge::class);
        BadgeService::add(Badges\VersionBadge::class);
    }
}
