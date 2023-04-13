<?php

declare(strict_types=1);

namespace App\Badges\EclipseMarketplace;

use App\Facades\BadgeService;
use Illuminate\Support\ServiceProvider;

final class BadgeServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        BadgeService::add(Badges\DownloadsBadge::class);
        BadgeService::add(Badges\FavoritesBadge::class);
        BadgeService::add(Badges\LastModifiedBadge::class);
        BadgeService::add(Badges\LicenseBadge::class);
        BadgeService::add(Badges\DownloadsPerMonthBadge::class);
        BadgeService::add(Badges\VersionBadge::class);
    }
}
