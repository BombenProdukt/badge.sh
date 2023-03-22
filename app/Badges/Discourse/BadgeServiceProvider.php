<?php

declare(strict_types=1);

namespace App\Badges\Discourse;

use App\Facades\BadgeService;
use Illuminate\Support\ServiceProvider;

final class BadgeServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        BadgeService::add(Badges\LikesBadge::class);
        BadgeService::add(Badges\PostsBadge::class);
        BadgeService::add(Badges\TopicsBadge::class);
        BadgeService::add(Badges\UsersBadge::class);
    }
}
