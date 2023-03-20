<?php

declare(strict_types=1);

namespace App\Badges\OpenCollective;

use App\Facades\BadgeService;
use Illuminate\Support\ServiceProvider;

final class BadgeServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        BadgeService::add(Badges\BackersBadge::class);
        BadgeService::add(Badges\BalanceBadge::class);
        BadgeService::add(Badges\ContributorsBadge::class);
        BadgeService::add(Badges\SponsorsBadge::class);
        BadgeService::add(Badges\SupportersBadge::class);
        BadgeService::add(Badges\YearlyBadge::class);
    }
}
