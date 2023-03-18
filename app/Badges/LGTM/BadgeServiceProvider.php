<?php

declare(strict_types=1);

namespace App\Badges\LGTM;

use App\Facades\BadgeService;
use Illuminate\Support\ServiceProvider;

final class BadgeServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        BadgeService::add(Badges\AlertsBadge::class);
        BadgeService::add(Badges\GradeBadge::class);
        BadgeService::add(Badges\LinesBadge::class);
        BadgeService::add(Badges\LangsBadge::class);
    }
}
