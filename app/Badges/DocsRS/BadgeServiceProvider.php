<?php

declare(strict_types=1);

namespace App\Badges\DocsRS;

use App\Facades\BadgeService;
use Illuminate\Support\ServiceProvider;

final class BadgeServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        BadgeService::add(Badges\StatusBadge::class);
    }
}
