<?php

declare(strict_types=1);

namespace App\Badges\XO;

use App\Badges\XO\Badges\IndentBadge;
use App\Badges\XO\Badges\SemicolonBadge;
use App\Badges\XO\Badges\StatusBadge;
use App\Facades\BadgeService;
use Illuminate\Support\ServiceProvider;

final class BadgeServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        BadgeService::add(IndentBadge::class);
        BadgeService::add(SemicolonBadge::class);
        BadgeService::add(StatusBadge::class);
    }
}
