<?php

declare(strict_types=1);

namespace App\Badges\Maintenance;

use App\Facades\BadgeService;
use Illuminate\Support\ServiceProvider;

final class BadgeServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        BadgeService::add(Badges\AbandonedBadge::class);
        BadgeService::add(Badges\MaintainedBadge::class);
        BadgeService::add(Badges\StaleBadge::class);
    }
}
