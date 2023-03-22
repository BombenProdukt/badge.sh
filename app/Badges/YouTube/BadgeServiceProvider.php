<?php

declare(strict_types=1);

namespace App\Badges\YouTube;

use App\Facades\BadgeService;
use Illuminate\Support\ServiceProvider;

final class BadgeServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        BadgeService::add(Badges\ChannelSubscribersBadge::class);
        BadgeService::add(Badges\ChannelVideosBadge::class);
        BadgeService::add(Badges\ChannelViewsBadge::class);
        BadgeService::add(Badges\VideoCommentsBadge::class);
        BadgeService::add(Badges\VideoLikesBadge::class);
        BadgeService::add(Badges\VideoViewsBadge::class);
    }
}
