<?php

declare(strict_types=1);

namespace App\Badges\Bundlephobia;

use App\Facades\BadgeService;
use Illuminate\Support\ServiceProvider;

final class BadgeServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        BadgeService::add(Badges\MinBadge::class);
        BadgeService::add(Badges\MinzipBadge::class);
        BadgeService::add(Badges\DependencyCountBadge::class);
        BadgeService::add(Badges\TreeShakingBadge::class);
    }
}
