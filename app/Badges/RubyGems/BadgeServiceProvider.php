<?php

declare(strict_types=1);

namespace App\Badges\RubyGems;

use App\Facades\BadgeService;
use Illuminate\Support\ServiceProvider;

final class BadgeServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        BadgeService::add(Badges\DownloadsBadge::class);
        BadgeService::add(Badges\LatestVersionDownloadsBadge::class);
        BadgeService::add(Badges\NameBadge::class);
        BadgeService::add(Badges\PlatformBadge::class);
        BadgeService::add(Badges\VersionBadge::class);
    }
}
