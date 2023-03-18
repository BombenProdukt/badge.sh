<?php

declare(strict_types=1);

namespace App\Badges\Jenkins;

use App\Facades\BadgeService;
use Illuminate\Support\ServiceProvider;

final class BadgeServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        BadgeService::add(Badges\LastBuildBadge::class);
        BadgeService::add(Badges\FixTimeBadge::class);
        BadgeService::add(Badges\BrokenBuildBadge::class);
    }
}
