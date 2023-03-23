<?php

declare(strict_types=1);

namespace App\Badges\Spiget;

use App\Facades\BadgeService;
use Illuminate\Support\ServiceProvider;

final class BadgeServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        BadgeService::add(Badges\DownloadsBadge::class);
        BadgeService::add(Badges\RatingBadge::class);
        BadgeService::add(Badges\SizeBadge::class);
        BadgeService::add(Badges\TestedVersionsBadge::class);
        BadgeService::add(Badges\VersionBadge::class);
    }
}
