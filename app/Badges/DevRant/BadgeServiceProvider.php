<?php

declare(strict_types=1);

namespace App\Badges\DevRant;

use App\Facades\BadgeService;
use Illuminate\Support\ServiceProvider;

final class BadgeServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        BadgeService::add(Badges\UserIdBadge::class);
        BadgeService::add(Badges\UsernameBadge::class);
    }
}
