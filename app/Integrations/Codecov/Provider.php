<?php

declare(strict_types=1);

namespace App\Integrations\Codecov;

use App\Integrations\Contracts\IntegrationProvider;
use Illuminate\Support\Facades\Route;

final class Provider implements IntegrationProvider
{
    public function name(): string
    {
        return 'Codecov';
    }

    public function register(): void
    {
        Route::prefix('codecov')->group(function (): void {
            //
        });
    }

    public function examples(): array
    {
        return [
            '/codecov/c/github/babel/babel'                         => 'coverage (github)',
            '/codecov/c/github/babel/babel/6.x'                     => 'coverage (github, branch)',
            '/codecov/c/bitbucket/ignitionrobotics/ign-math'        => 'coverage (bitbucket)',
            '/codecov/c/bitbucket/ignitionrobotics/ign-math/master' => 'coverage (bitbucket, branch)',
            '/codecov/c/gitlab/gitlab-org/gitaly'                   => 'coverage (gitlab)',
            '/codecov/c/gitlab/gitlab-org/gitaly/master'            => 'coverage (gitlab, branch)',
        ];
    }
}
