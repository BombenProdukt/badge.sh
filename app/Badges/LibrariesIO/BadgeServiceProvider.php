<?php

declare(strict_types=1);

namespace App\Badges\LibrariesIO;

use App\Facades\BadgeService;
use Illuminate\Support\ServiceProvider;

final class BadgeServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        BadgeService::add(Badges\DependentRepositoriesBadge::class);
        BadgeService::add(Badges\DependentsBadge::class);
        BadgeService::add(Badges\ProjectDependenciesBadge::class);
        BadgeService::add(Badges\RepositoryDependenciesBadge::class);
        BadgeService::add(Badges\SourceRankBadge::class);
    }
}
