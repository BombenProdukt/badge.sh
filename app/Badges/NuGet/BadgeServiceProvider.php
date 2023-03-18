<?php

declare(strict_types=1);

namespace App\Badges\NuGet;

use App\Facades\BadgeService;
use Illuminate\Support\ServiceProvider;

final class BadgeServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        BadgeService::add(Badges\VersionBadge::class);
        BadgeService::add(Badges\TotalDownloadsBadge::class);
    }
}
