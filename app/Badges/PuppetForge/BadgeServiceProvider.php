<?php

declare(strict_types=1);

namespace App\Badges\PuppetForge;

use App\Facades\BadgeService;
use Illuminate\Support\ServiceProvider;

final class BadgeServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        BadgeService::add(Badges\ModuleDownloads::class);
        BadgeService::add(Badges\ModuleEndorsement::class);
        BadgeService::add(Badges\ModuleFeedback::class);
        BadgeService::add(Badges\ModulePdkVersion::class);
        BadgeService::add(Badges\ModuleVersion::class);
        BadgeService::add(Badges\UserModuleCount::class);
        BadgeService::add(Badges\UserReleaseCount::class);
    }
}
