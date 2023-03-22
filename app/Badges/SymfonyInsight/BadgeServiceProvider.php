<?php

declare(strict_types=1);

namespace App\Badges\SymfonyInsight;

use App\Facades\BadgeService;
use Illuminate\Support\ServiceProvider;

final class BadgeServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        BadgeService::add(Badges\GradeBadge::class);
        BadgeService::add(Badges\StarsBadge::class);
        BadgeService::add(Badges\ViolationsBadge::class);
    }
}
