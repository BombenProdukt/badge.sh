<?php

declare(strict_types=1);

namespace App\Badges\StackExchange;

use App\Facades\BadgeService;
use Illuminate\Support\ServiceProvider;

final class BadgeServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        BadgeService::add(Badges\MonthlyQuestionsBadge::class);
        BadgeService::add(Badges\TagInfoBadge::class);
        BadgeService::add(Badges\UserAcceptRateBadge::class);
        BadgeService::add(Badges\UserDisplayNameBadge::class);
        BadgeService::add(Badges\UserLocationBadge::class);
        BadgeService::add(Badges\UserReputationBadge::class);
        BadgeService::add(Badges\UserWebsiteBadge::class);
    }
}
