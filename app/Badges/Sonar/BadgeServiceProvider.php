<?php

declare(strict_types=1);

namespace App\Badges\Sonar;

use App\Facades\BadgeService;
use Illuminate\Support\ServiceProvider;

final class BadgeServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        BadgeService::add(Badges\CoverageBadge::class);
        BadgeService::add(Badges\DocumentApiDensityBadge::class);
        BadgeService::add(Badges\FortifyRatingBadge::class);
        BadgeService::add(Badges\QualityGateBadge::class);
        BadgeService::add(Badges\TechDebtBadge::class);
        BadgeService::add(Badges\TestsBadge::class);
        BadgeService::add(Badges\ViolationsBadge::class);
        BadgeService::add(Badges\GenericBadge::class);
    }
}
