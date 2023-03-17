<?php

declare(strict_types=1);

namespace App\Integrations\GitHub;

use App\Integrations\Contracts\IntegrationProvider;
use App\Integrations\GitHub\Controllers\BranchesController;
use App\Integrations\GitHub\Controllers\ChecksController;
use App\Integrations\GitHub\Controllers\ClosedIssuesController;
use App\Integrations\GitHub\Controllers\ClosedPullRequestsController;
use App\Integrations\GitHub\Controllers\CommitsController;
use App\Integrations\GitHub\Controllers\ContributorsController;
use App\Integrations\GitHub\Controllers\DependabotStatusController;
use App\Integrations\GitHub\Controllers\DownloadsController;
use App\Integrations\GitHub\Controllers\ForksController;
use App\Integrations\GitHub\Controllers\IssuesController;
use App\Integrations\GitHub\Controllers\LabelsController;
use App\Integrations\GitHub\Controllers\LastCommitController;
use App\Integrations\GitHub\Controllers\LicenseController;
use App\Integrations\GitHub\Controllers\MergedPullRequestsController;
use App\Integrations\GitHub\Controllers\MilestonesController;
use App\Integrations\GitHub\Controllers\OpenIssuesController;
use App\Integrations\GitHub\Controllers\OpenPullRequestsController;
use App\Integrations\GitHub\Controllers\PackageDependentsController;
use App\Integrations\GitHub\Controllers\PullRequestsController;
use App\Integrations\GitHub\Controllers\ReleaseController;
use App\Integrations\GitHub\Controllers\ReleasesController;
use App\Integrations\GitHub\Controllers\RepositoryDependentsController;
use App\Integrations\GitHub\Controllers\StarsController;
use App\Integrations\GitHub\Controllers\StatusController;
use App\Integrations\GitHub\Controllers\TagController;
use App\Integrations\GitHub\Controllers\TagsController;
use App\Integrations\GitHub\Controllers\WatchersController;
use Illuminate\Support\Facades\Route;

final class Provider implements IntegrationProvider
{
    public function name(): string
    {
        return 'GitHub';
    }

    public function register(): void
    {
        Route::prefix('github')->group(function (): void {
            Route::get('assets-dl/{owner}/{repo}/{tag?}', DownloadsController::class);
            Route::get('branches/{owner}/{repo}', BranchesController::class);
            Route::get('checks/{owner}/{repo}/{reference?}/{context?}', ChecksController::class)->where('context', '.+');
            Route::get('closed-issues/{owner}/{repo}', ClosedIssuesController::class);
            Route::get('closed-prs/{owner}/{repo}', ClosedPullRequestsController::class);
            Route::get('commits/{owner}/{repo}/{reference?}', CommitsController::class);
            Route::get('contributors/{owner}/{repo}', ContributorsController::class);
            Route::get('dependabot/{owner}/{repo}', DependabotStatusController::class);
            Route::get('dependents-pkg/{owner}/{repo}', PackageDependentsController::class);
            Route::get('dependents-repo/{owner}/{repo}', RepositoryDependentsController::class);
            Route::get('dt/{owner}/{repo}/{tag?}', DownloadsController::class);
            Route::get('forks/{owner}/{repo}', ForksController::class);
            Route::get('issues/{owner}/{repo}', IssuesController::class);
            Route::get('label-issues/{owner}/{repo}/{label}/{states?}', LabelsController::class)->whereIn('states', ['open', 'closed']);
            Route::get('last-commit/{owner}/{repo}/{reference?}', LastCommitController::class);
            Route::get('license/{owner}/{repo}', LicenseController::class);
            Route::get('merged-prs/{owner}/{repo}', MergedPullRequestsController::class);
            Route::get('milestones/{owner}/{repo}/{milestoneNumber}', MilestonesController::class);
            Route::get('open-issues/{owner}/{repo}', OpenIssuesController::class);
            Route::get('open-prs/{owner}/{repo}', OpenPullRequestsController::class);
            Route::get('prs/{owner}/{repo}', PullRequestsController::class);
            Route::get('release/{owner}/{repo}/{channel?}', ReleaseController::class);
            Route::get('releases/{owner}/{repo}', ReleasesController::class);
            Route::get('stars/{owner}/{repo}', StarsController::class);
            Route::get('status/{owner}/{repo}/{reference?}/{context?}', StatusController::class)->where('context', '.+');
            Route::get('tag/{owner}/{repo}', TagController::class);
            Route::get('tags/{owner}/{repo}', TagsController::class);
            Route::get('watchers/{owner}/{repo}', WatchersController::class);
        });
    }

    public function examples(): array
    {
        return [
            '/github/release/babel/babel'                                              => 'latest release',
            '/github/release/babel/babel/stable'                                       => 'latest stable release',
            '/github/tag/micromatch/micromatch'                                        => 'latest tag',
            '/github/watchers/micromatch/micromatch'                                   => 'watchers',
            '/github/checks/tunnckoCore/opensource'                                    => 'combined checks (default branch)',
            '/github/checks/node-formidable/node-formidable'                           => 'combined checks (default branch)',
            '/github/checks/node-formidable/node-formidable/master/lint'               => 'single checks (lint job)',
            '/github/checks/node-formidable/node-formidable/master/test'               => 'single checks (test job)',
            '/github/checks/node-formidable/node-formidable/master/ubuntu?label=linux' => 'single checks (linux)',
            '/github/checks/node-formidable/node-formidable/master/windows'            => 'single checks (windows)',
            '/github/checks/node-formidable/node-formidable/master/macos'              => 'single checks (macos)',
            '/github/checks/styfle/packagephobia/main'                                 => 'combined checks (branch)',
            '/github/status/micromatch/micromatch'                                     => 'combined statuses (default branch)',
            '/github/status/micromatch/micromatch/gh-pages'                            => 'combined statuses (branch)',
            '/github/status/micromatch/micromatch/f4809eb6df80b'                       => 'combined statuses (commit)',
            '/github/status/micromatch/micromatch/4.0.1'                               => 'combined statuses (tag)',
            '/github/status/facebook/react/master/ci/circleci:%20yarn_test'            => 'single status',
            '/github/status/zeit/hyper/master/ci'                                      => 'combined statuses (ci*)',
            '/github/status/zeit/hyper/master/ci/circleci'                             => 'combined statuses (ci/circleci*)',
            '/github/status/zeit/hyper/master/ci/circleci:%20build'                    => 'single status',
            '/github/stars/micromatch/micromatch'                                      => 'stars',
            '/github/forks/micromatch/micromatch'                                      => 'forks',
            '/github/issues/micromatch/micromatch'                                     => 'issues',
            '/github/open-issues/micromatch/micromatch'                                => 'open issues',
            '/github/closed-issues/micromatch/micromatch'                              => 'closed issues',
            '/github/label-issues/nodejs/node/ES%20Modules'                            => 'issues by label',
            '/github/label-issues/atom/atom/help-wanted/open'                          => 'open issues by label',
            '/github/label-issues/rust-lang/rust/B-RFC-approved/closed'                => 'closed issues by label',
            '/github/prs/micromatch/micromatch'                                        => 'PRs',
            '/github/open-prs/micromatch/micromatch'                                   => 'open PRs',
            '/github/closed-prs/micromatch/micromatch'                                 => 'closed PRs',
            '/github/merged-prs/micromatch/micromatch'                                 => 'merged PRs',
            '/github/milestones/chrislgarry/Apollo-11/1'                               => 'milestone percentage',
            '/github/commits/micromatch/micromatch'                                    => 'commits count',
            '/github/commits/micromatch/micromatch/gh-pages'                           => 'commits count (branch ref)',
            '/github/commits/micromatch/micromatch/4.0.1'                              => 'commits count (tag ref)',
            '/github/last-commit/micromatch/micromatch'                                => 'last commit',
            '/github/last-commit/micromatch/micromatch/gh-pages'                       => 'last commit (branch ref)',
            '/github/last-commit/micromatch/micromatch/4.0.1'                          => 'last commit (tag ref)',
            '/github/branches/micromatch/micromatch'                                   => 'branches',
            '/github/releases/micromatch/micromatch'                                   => 'releases',
            '/github/tags/micromatch/micromatch'                                       => 'tags',
            '/github/license/micromatch/micromatch'                                    => 'license',
            '/github/contributors/micromatch/micromatch'                               => 'contributors',
            '/github/assets-dl/electron/electron'                                      => 'assets downloads for latest release',
            '/github/assets-dl/electron/electron/v7.0.0'                               => 'assets downloads for a tag',
            '/github/dependents-repo/micromatch/micromatch'                            => 'repository dependents',
            '/github/dependents-pkg/micromatch/micromatch'                             => 'package dependents',
            '/github/dependabot/ubuntu/yaru'                                           => 'dependabot status',
        ];
    }
}
