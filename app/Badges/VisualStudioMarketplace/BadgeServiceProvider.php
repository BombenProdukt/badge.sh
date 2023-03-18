<?php

declare(strict_types=1);

namespace App\Badges\VisualStudioMarketplace;

use App\Facades\BadgeService;
use Illuminate\Support\ServiceProvider;

final class BadgeServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        BadgeService::add(Badges\VersionBadge::class);
        BadgeService::add(Badges\DownloadsBadge::class);
        BadgeService::add(Badges\InstallsBadge::class);
        BadgeService::add(Badges\RatingBadge::class);
    }
}
