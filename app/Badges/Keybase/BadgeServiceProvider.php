<?php

declare(strict_types=1);

namespace App\Badges\Keybase;

use App\Facades\BadgeService;
use Illuminate\Support\ServiceProvider;

final class BadgeServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        BadgeService::add(Badges\BTCBadge::class);
        BadgeService::add(Badges\PGPBadge::class);
        BadgeService::add(Badges\XLMBadge::class);
        BadgeService::add(Badges\ZECBadge::class);
    }
}
