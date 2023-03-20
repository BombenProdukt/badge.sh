<?php

declare(strict_types=1);

namespace App\Badges\Liberapay;

use App\Facades\BadgeService;
use Illuminate\Support\ServiceProvider;

final class BadgeServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        BadgeService::add(Badges\GivesBadge::class);
        BadgeService::add(Badges\GoalBadge::class);
        BadgeService::add(Badges\PatronsBadge::class);
        BadgeService::add(Badges\ReceivesBadge::class);
    }
}
