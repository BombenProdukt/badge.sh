<?php

declare(strict_types=1);

namespace App\Badges\Composer;

use App\Facades\BadgeService;
use Illuminate\Support\ServiceProvider;

final class BadgeServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        BadgeService::add(Badges\KeywordsBadge::class);
        BadgeService::add(Badges\LicenseBadge::class);
        BadgeService::add(Badges\PhpVersion::class);
        BadgeService::add(Badges\RequireBadge::class);
        BadgeService::add(Badges\RequireDevBadge::class);
        BadgeService::add(Badges\TypeBadge::class);
    }
}
