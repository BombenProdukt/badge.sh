<?php

declare(strict_types=1);

namespace App\Badges\WhatPulse;

use App\Facades\BadgeService;
use Illuminate\Support\ServiceProvider;

final class BadgeServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        BadgeService::add(Badges\DownloadBadge::class);
        BadgeService::add(Badges\UploadBadge::class);
        BadgeService::add(Badges\ClicksBadge::class);
        BadgeService::add(Badges\KeysBadge::class);
        BadgeService::add(Badges\PulsesBadge::class);
        BadgeService::add(Badges\UptimeBadge::class);
    }
}
