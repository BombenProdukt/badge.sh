<?php

declare(strict_types=1);

namespace App\Badges\CodeClimate;

use App\Facades\BadgeService;
use Illuminate\Support\ServiceProvider;

final class BadgeServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        BadgeService::add(Badges\LinesBadge::class);
        BadgeService::add(Badges\IssuesBadge::class);
        BadgeService::add(Badges\TechDebtBadge::class);
        BadgeService::add(Badges\MaintainabilityBadge::class);
        BadgeService::add(Badges\MaintainabilityPercentageBadge::class);
        BadgeService::add(Badges\CoverageGradeBadge::class);
        BadgeService::add(Badges\CoverageBadge::class);
    }
}
