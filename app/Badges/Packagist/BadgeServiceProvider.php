<?php

declare(strict_types=1);

namespace App\Badges\Packagist;

use App\Facades\BadgeService;
use Illuminate\Support\ServiceProvider;

final class BadgeServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        BadgeService::add(Badges\DailyDownloadsBadge::class);
        BadgeService::add(Badges\DependentsBadge::class);
        BadgeService::add(Badges\MonthlyDownloadsBadge::class);
        BadgeService::add(Badges\TotalDownloadsBadge::class);
        BadgeService::add(Badges\FaversBadge::class);
        BadgeService::add(Badges\GitHubForksBadge::class);
        BadgeService::add(Badges\GitHubIssuesBadge::class);
        BadgeService::add(Badges\GitHubStarsBadge::class);
        BadgeService::add(Badges\GitHubWatchersBadge::class);
        BadgeService::add(Badges\LanguageBadge::class);
        BadgeService::add(Badges\LicenseBadge::class);
        BadgeService::add(Badges\NameBadge::class);
        BadgeService::add(Badges\NameBadge::class);
        BadgeService::add(Badges\PhpVersionBadge::class);
        BadgeService::add(Badges\SuggestersBadge::class);
        BadgeService::add(Badges\VersionBadge::class);
    }
}
