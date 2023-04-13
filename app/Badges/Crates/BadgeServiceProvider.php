<?php

declare(strict_types=1);

namespace App\Badges\Crates;

use App\Facades\BadgeService;
use Illuminate\Support\ServiceProvider;

final class BadgeServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        BadgeService::add(Badges\LatestVersionBadge::class);
        BadgeService::add(Badges\DownloadsBadge::class);
        BadgeService::add(Badges\LatestVersionDownloadsBadge::class);
    }
}
