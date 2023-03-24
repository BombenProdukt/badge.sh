<?php

declare(strict_types=1);

namespace App\Badges\VisualStudioAppCenter;

use App\Facades\BadgeService;
use Illuminate\Support\ServiceProvider;

final class BadgeServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        BadgeService::add(Badges\BuildsBadge::class);
        BadgeService::add(Badges\ReleaseOperatingSystemVersionBadge::class);
        BadgeService::add(Badges\ReleaseSizeBadge::class);
        BadgeService::add(Badges\ReleaseVersionBadge::class);
    }
}
