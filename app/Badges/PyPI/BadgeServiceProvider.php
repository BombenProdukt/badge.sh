<?php

declare(strict_types=1);

namespace App\Badges\PyPI;

use App\Facades\BadgeService;
use Illuminate\Support\ServiceProvider;

final class BadgeServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        BadgeService::add(Badges\VersionBadge::class);
        BadgeService::add(Badges\LicenseBadge::class);
        BadgeService::add(Badges\PythonBadge::class);
        BadgeService::add(Badges\WheelsBadge::class);
    }
}
