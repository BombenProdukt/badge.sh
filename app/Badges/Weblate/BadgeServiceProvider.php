<?php

declare(strict_types=1);

namespace App\Badges\Weblate;

use App\Facades\BadgeService;
use Illuminate\Support\ServiceProvider;

final class BadgeServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        BadgeService::add(Badges\EntitiesBadge::class);
        BadgeService::add(Badges\LicenseBadge::class);
        BadgeService::add(Badges\ProgressBadge::class);
        BadgeService::add(Badges\UserStatisticsBadge::class);
    }
}
