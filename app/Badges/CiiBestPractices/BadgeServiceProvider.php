<?php

declare(strict_types=1);

namespace App\Badges\CiiBestPractices;

use App\Facades\BadgeService;
use Illuminate\Support\ServiceProvider;

final class BadgeServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        BadgeService::add(Badges\LevelBadge::class);
        BadgeService::add(Badges\PercentageBadge::class);
        BadgeService::add(Badges\SummaryBadge::class);
    }
}
