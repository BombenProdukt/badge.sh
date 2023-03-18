<?php

declare(strict_types=1);

namespace App\Badges\GitLab;

use App\Facades\BadgeService;
use Illuminate\Support\ServiceProvider;

final class BadgeServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        BadgeService::add(Badges\StarsBadge::class);
        BadgeService::add(Badges\ForksBadge::class);
        BadgeService::add(Badges\IssuesBadge::class);
        BadgeService::add(Badges\OpenIssuesBadge::class);
        BadgeService::add(Badges\ClosedIssuesBadge::class);
        BadgeService::add(Badges\MergeRequestsBadge::class);
        BadgeService::add(Badges\OpenMergeRequestsBadge::class);
        BadgeService::add(Badges\ClosedMergeRequestsBadge::class);
        BadgeService::add(Badges\MergedMergeRequestsBadge::class);
        BadgeService::add(Badges\BranchesBadge::class);
        BadgeService::add(Badges\ReleasesBadge::class);
        BadgeService::add(Badges\ReleaseBadge::class);
        BadgeService::add(Badges\TagsBadge::class);
        BadgeService::add(Badges\LicenseBadge::class);
        BadgeService::add(Badges\ContributorsBadge::class);
        BadgeService::add(Badges\LabelsBadge::class);
        BadgeService::add(Badges\CommitsBadge::class);
        BadgeService::add(Badges\LastCommitBadge::class);
    }
}
