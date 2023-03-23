<?php

declare(strict_types=1);

namespace App\Badges\AzureDevOps;

use App\Facades\BadgeService;
use Illuminate\Support\ServiceProvider;

final class BadgeServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        BadgeService::add(Badges\BuildStatusBadge::class);
        BadgeService::add(Badges\BuildVersionBadge::class);
        BadgeService::add(Badges\BuildTestResultBadge::class);
        BadgeService::add(Badges\CoverageBadge::class);
        BadgeService::add(Badges\ReleaseBadge::class);
        BadgeService::add(Badges\DeploymentBadge::class);
        BadgeService::add(Badges\StatusBadge::class);
    }
}
