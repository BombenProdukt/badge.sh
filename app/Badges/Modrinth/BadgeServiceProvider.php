<?php

declare(strict_types=1);

namespace App\Badges\Modrinth;

use App\Facades\BadgeService;
use Illuminate\Support\ServiceProvider;

final class BadgeServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        BadgeService::add(Badges\DownloadsBadge::class);
        BadgeService::add(Badges\FollowersBadge::class);
        BadgeService::add(Badges\GameVersionsBadge::class);
        BadgeService::add(Badges\VersionBadge::class);
    }
}
