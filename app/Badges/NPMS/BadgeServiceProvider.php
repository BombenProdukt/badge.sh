<?php

declare(strict_types=1);

namespace App\Badges\NPMS;

use App\Facades\BadgeService;
use Illuminate\Support\ServiceProvider;

final class BadgeServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        BadgeService::add(Badges\FinalScoreBadge::class);
        BadgeService::add(Badges\MaintenanceScoreBadge::class);
        BadgeService::add(Badges\PopularityScoreBadge::class);
        BadgeService::add(Badges\QualityScoreBadge::class);
    }
}
