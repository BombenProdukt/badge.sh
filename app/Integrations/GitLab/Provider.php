<?php

declare(strict_types=1);

namespace App\Integrations\GitLab;

use App\Integrations\Contracts\IntegrationProvider;
use Illuminate\Support\Facades\Route;

final class Provider implements IntegrationProvider
{
    public function name(): string
    {
        return 'Gitlab';
    }

    public function register(): void
    {
        Route::prefix('gitlab')->group(function (): void {
            Route::get('stars/{owner}/{repo}', Controllers\StarsController::class);
            Route::get('forks/{owner}/{repo}', Controllers\ForksController::class);
            Route::get('issues/{owner}/{repo}', Controllers\IssuesController::class);
            Route::get('open-issues/{owner}/{repo}', Controllers\OpenIssuesController::class);
            Route::get('closed-issues/{owner}/{repo}', Controllers\ClosedIssuesController::class);
            Route::get('mrs/{owner}/{repo}', Controllers\MergeRequestsController::class);
            Route::get('open-mrs/{owner}/{repo}', Controllers\OpenMergeRequestsController::class);
            Route::get('closed-mrs/{owner}/{repo}', Controllers\ClosedMergeRequestsController::class);
            Route::get('merged-mrs/{owner}/{repo}', Controllers\MergedMergeRequestsController::class);
            Route::get('branches/{owner}/{repo}', Controllers\BranchesController::class);
            Route::get('releases/{owner}/{repo}', Controllers\ReleasesController::class);
            Route::get('release/{owner}/{repo}', Controllers\ReleaseController::class);
            Route::get('tags/{owner}/{repo}', Controllers\TagsController::class);
            Route::get('license/{owner}/{repo}', Controllers\LicenseController::class);
            Route::get('contributors/{owner}/{repo}', Controllers\ContributorsController::class);
            Route::get('label-issues/{owner}/{repo}/{label}/{state?}', Controllers\LabelsController::class);
            Route::get('commits/{owner}/{repo}/{ref?}', Controllers\CommitsController::class);
            Route::get('last-commit/{owner}/{repo}/{ref?}', Controllers\LastCommitController::class);
        });
    }

    public function examples(): array
    {
        return [
            '/gitlab/stars/fdroid/fdroidclient'                                                      => 'stars',
            '/gitlab/forks/inkscape/inkscape'                                                        => 'forks',
            '/gitlab/issues/gitlab-org/gitlab-runner'                                                => 'issues',
            '/gitlab/open-issues/gitlab-org/gitlab-runner'                                           => 'issues',
            '/gitlab/closed-issues/gitlab-org/gitlab-runner'                                         => 'issues',
            '/gitlab/label-issues/NickBusey/HomelabOS/Bug'                                           => 'issues by label',
            '/gitlab/label-issues/NickBusey/HomelabOS/Enhancement/opened'                            => 'open issues by label',
            '/gitlab/label-issues/NickBusey/HomelabOS/Help%20wanted/closed'                          => 'closed issues by label',
            '/gitlab/mrs/edouardklein/falsisign'                                                     => 'MRs',
            '/gitlab/open-mrs/edouardklein/falsisign'                                                => 'open MRs',
            '/gitlab/closed-mrs/edouardklein/falsisign'                                              => 'closed MRs',
            '/gitlab/merged-mrs/edouardklein/falsisign'                                              => 'merged MRs',
            '/gitlab/branches/gitlab-org%2fgitter/webapp'                                            => 'branches',
            '/gitlab/releases/AuroraOSS/AuroraStore'                                                 => 'release',
            '/gitlab/release/veloren/veloren'                                                        => 'latest release',
            '/gitlab/tags/commento/commento'                                                         => 'tags',
            '/gitlab/contributors/graphviz/graphviz'                                                 => 'contributors',
            '/gitlab/license/gitlab-org/omnibus-gitlab'                                              => 'license',
            '/gitlab/commits/cryptsetup/cryptsetup'                                                  => 'commits count',
            '/gitlab/commits/cryptsetup/cryptsetup/coverity_scan'                                    => 'commits count (branch ref)',
            '/gitlab/commits/cryptsetup/cryptsetup/v2.2.2'                                           => 'commits count (tag ref)',
            '/gitlab/last-commit/gitlab-org/gitlab-development-kit'                                  => 'last commit',
            '/gitlab/last-commit/gitlab-org/gitlab-development-kit/updating-chromedriver-install-v2' => 'last commit (branch ref)',
            '/gitlab/last-commit/gitlab-org/gitlab-development-kit/v0.2.5'                           => 'last commit (tag ref)',
        ];
    }
}
