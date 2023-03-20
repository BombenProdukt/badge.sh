<?php

declare(strict_types=1);

namespace App\Badges\CocoaPods;

use App\Facades\BadgeService;
use Illuminate\Support\ServiceProvider;

final class BadgeServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        BadgeService::add(Badges\DocsBadge::class);
        BadgeService::add(Badges\LicenseBadge::class);
        BadgeService::add(Badges\PlatformBadge::class);
        BadgeService::add(Badges\VersionBadge::class);
    }
}