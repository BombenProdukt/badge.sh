<?php

declare(strict_types=1);

namespace App\Badges\Docker;

use App\Facades\BadgeService;
use Illuminate\Support\ServiceProvider;

final class BadgeServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        BadgeService::add(Badges\CloudAutomatedBuildBadge::class);
        BadgeService::add(Badges\CloudBuildStatusBadge::class);
        BadgeService::add(Badges\PullsBadge::class);
        BadgeService::add(Badges\SizeBadge::class);
        BadgeService::add(Badges\LayersBadge::class);
        BadgeService::add(Badges\MetadataBadge::class);
    }
}
