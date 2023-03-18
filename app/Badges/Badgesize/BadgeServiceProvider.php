<?php

declare(strict_types=1);

namespace App\Badges\Badgesize;

use App\Facades\BadgeService;
use Illuminate\Support\ServiceProvider;

final class BadgeServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        BadgeService::add(Badges\GitHubBadge::class);
        BadgeService::add(Badges\UrlBadge::class);
        BadgeService::add(Badges\UrlBadge::class);
    }
}
