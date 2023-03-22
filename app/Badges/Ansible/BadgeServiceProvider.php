<?php

declare(strict_types=1);

namespace App\Badges\Ansible;

use App\Facades\BadgeService;
use Illuminate\Support\ServiceProvider;

final class BadgeServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        BadgeService::add(Badges\CollectionBadge::class);
        BadgeService::add(Badges\QualityBadge::class);
        BadgeService::add(Badges\RoleBadge::class);
    }
}
