<?php

declare(strict_types=1);

namespace App\Badges\Discord;

use App\Facades\BadgeService;
use Illuminate\Support\ServiceProvider;

final class BadgeServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        BadgeService::add(Badges\MembersBadge::class);
        BadgeService::add(Badges\OnlineMembersBadge::class);
    }
}
