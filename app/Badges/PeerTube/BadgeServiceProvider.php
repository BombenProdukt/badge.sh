<?php

declare(strict_types=1);

namespace App\Badges\PeerTube;

use App\Facades\BadgeService;
use Illuminate\Support\ServiceProvider;

final class BadgeServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        BadgeService::add(Badges\CommentsBadge::class);
        BadgeService::add(Badges\ViewsBadge::class);
        BadgeService::add(Badges\VotesBadge::class);
        BadgeService::add(Badges\FollowersBadge::class);
    }
}
