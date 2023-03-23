<?php

declare(strict_types=1);

namespace App\Badges\Bitbucket;

use App\Facades\BadgeService;
use Illuminate\Support\ServiceProvider;

final class BadgeServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        BadgeService::add(Badges\OpenIssuesBadge::class);
        BadgeService::add(Badges\OpenPullRequestsBadge::class);
        BadgeService::add(Badges\PipelinesBadge::class);
    }
}
