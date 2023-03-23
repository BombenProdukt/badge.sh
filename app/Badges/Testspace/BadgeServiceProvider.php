<?php

declare(strict_types=1);

namespace App\Badges\Testspace;

use App\Facades\BadgeService;
use Illuminate\Support\ServiceProvider;

final class BadgeServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        BadgeService::add(Badges\ErroredCountBadge::class);
        BadgeService::add(Badges\FailedCountBadge::class);
        BadgeService::add(Badges\PassedCountBadge::class);
        BadgeService::add(Badges\PassRatioBadge::class);
        BadgeService::add(Badges\SkippedCountBadge::class);
        BadgeService::add(Badges\SummaryBadge::class);
        BadgeService::add(Badges\TotalCountBadge::class);
        BadgeService::add(Badges\UntestedCountBadge::class);
    }
}
