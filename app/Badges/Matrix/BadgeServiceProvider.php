<?php

declare(strict_types=1);

namespace App\Badges\Matrix;

use App\Facades\BadgeService;
use Illuminate\Support\ServiceProvider;

final class BadgeServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        BadgeService::add(Badges\MemberBadge::class);
    }
}
