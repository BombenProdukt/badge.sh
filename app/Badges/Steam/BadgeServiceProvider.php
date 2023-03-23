<?php

declare(strict_types=1);

namespace App\Badges\Steam;

use App\Facades\BadgeService;
use Illuminate\Support\ServiceProvider;

final class BadgeServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        BadgeService::add(Badges\CollectionSizeBadge::class);
        BadgeService::add(Badges\FileDownloadsBadge::class);
        BadgeService::add(Badges\FileFavoritesBadge::class);
        BadgeService::add(Badges\FileLastModifiedBadge::class);
        BadgeService::add(Badges\FileReleaseDateBadge::class);
        BadgeService::add(Badges\FileSizeBadge::class);
        BadgeService::add(Badges\FileSubscriptionsBadge::class);
        BadgeService::add(Badges\FileViewsBadge::class);
    }
}
