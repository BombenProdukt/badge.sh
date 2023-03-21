<?php

declare(strict_types=1);

namespace App\Badges\GitHub;

use App\Facades\BadgeService;
use Illuminate\Support\ServiceProvider;

final class BadgeServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        BadgeService::add(Badges\BranchesBadge::class);
        BadgeService::add(Badges\CheckRunsBadge::class);
        BadgeService::add(Badges\CheckStatusBadge::class);
        BadgeService::add(Badges\ClosedIssuesBadge::class);
        BadgeService::add(Badges\ClosedPullRequestsBadge::class);
        BadgeService::add(Badges\LastCommitBadge::class);
        BadgeService::add(Badges\CommitsBadge::class);
        BadgeService::add(Badges\ContributorsBadge::class);
        BadgeService::add(Badges\DependabotStatusBadge::class);
        BadgeService::add(Badges\DownloadsBadge::class);
        BadgeService::add(Badges\DownloadsBadge::class);
        BadgeService::add(Badges\ForksBadge::class);
        BadgeService::add(Badges\GoModBadge::class);
        BadgeService::add(Badges\IssuesBadge::class);
        BadgeService::add(Badges\LabelsBadge::class);
        BadgeService::add(Badges\LanguageBadge::class);
        BadgeService::add(Badges\LanguagesBadge::class);
        BadgeService::add(Badges\LernaBadge::class);
        BadgeService::add(Badges\LicenseBadge::class);
        BadgeService::add(Badges\MergedPullRequestsBadge::class);
        BadgeService::add(Badges\MilestonesBadge::class);
        BadgeService::add(Badges\OpenIssuesBadge::class);
        BadgeService::add(Badges\OpenPullRequestsBadge::class);
        BadgeService::add(Badges\PackageDependentsBadge::class);
        BadgeService::add(Badges\PullRequestsBadge::class);
        BadgeService::add(Badges\ReleaseBadge::class);
        BadgeService::add(Badges\ReleasesBadge::class);
        BadgeService::add(Badges\RepositoryDependentsBadge::class);
        BadgeService::add(Badges\SearchBadge::class);
        BadgeService::add(Badges\SizeBadge::class);
        BadgeService::add(Badges\SponsorsBadge::class);
        BadgeService::add(Badges\StarsBadge::class);
        BadgeService::add(Badges\TagBadge::class);
        BadgeService::add(Badges\TagsBadge::class);
        BadgeService::add(Badges\TopLanguageBadge::class);
        BadgeService::add(Badges\WatchersBadge::class);
    }
}
