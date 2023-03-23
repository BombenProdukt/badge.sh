<?php

declare(strict_types=1);

namespace App\Badges\ScrutinizerCI;

use App\Facades\BadgeService;
use Illuminate\Support\ServiceProvider;

final class BadgeServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        BadgeService::add(Badges\BuildBadge::class);
        BadgeService::add(Badges\CoverageBadge::class);
        BadgeService::add(Badges\QualityBadge::class);
    }
}
