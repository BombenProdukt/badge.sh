<?php

declare(strict_types=1);

namespace App\Badges\AUR;

use App\Facades\BadgeService;
use Illuminate\Support\ServiceProvider;

final class BadgeServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        BadgeService::add(Badges\LastModifiedBadge::class);
        BadgeService::add(Badges\LicenseBadge::class);
        BadgeService::add(Badges\MaintainerBadge::class);
        BadgeService::add(Badges\PopularityBadge::class);
        BadgeService::add(Badges\VersionBadge::class);
        BadgeService::add(Badges\VotesBadge::class);
    }
}
