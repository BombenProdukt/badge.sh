<?php

declare(strict_types=1);

namespace App\Integrations\Gitlab;

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
            //
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
