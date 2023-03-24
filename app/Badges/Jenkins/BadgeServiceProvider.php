<?php

declare(strict_types=1);

namespace App\Badges\Jenkins;

use App\Facades\BadgeService;
use Illuminate\Support\ServiceProvider;

final class BadgeServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        BadgeService::add(Badges\BrokenBuildBadge::class);
        BadgeService::add(Badges\CoverageBadge::class);
        BadgeService::add(Badges\FixTimeBadge::class);
        BadgeService::add(Badges\LastBuildBadge::class);
        BadgeService::add(Badges\PluginDownloadsBadge::class);
        BadgeService::add(Badges\PluginPopularityBadge::class);
        BadgeService::add(Badges\PluginSizeBadge::class);
        BadgeService::add(Badges\PluginVersionBadge::class);
    }
}
