<?php

declare(strict_types=1);

namespace App\Badges\Reddit;

use App\Facades\BadgeService;
use Illuminate\Support\ServiceProvider;

final class BadgeServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        BadgeService::add(Badges\TotalKarmaBadge::class);
        BadgeService::add(Badges\CommentKarmaBadge::class);
        BadgeService::add(Badges\PostKarmaBadge::class);
        BadgeService::add(Badges\SubscribersBadge::class);
    }
}
