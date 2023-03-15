<?php

declare(strict_types=1);

namespace App\Integrations\Coveralls;

use App\Integrations\Contracts\IntegrationProvider;
use App\Integrations\Coveralls\Controllers\CoverageController;
use Illuminate\Support\Facades\Route;

final class Provider implements IntegrationProvider
{
    public function name(): string
    {
        return 'Coveralls';
    }

    public function register(): void
    {
        Route::prefix('coveralls')->group(function (): void {
            Route::get('c/{vcs}/{owner}/{repo}/{branch?}', CoverageController::class)->whereIn('vcs', ['github', 'bitbucket']);
        });
    }

    public function examples(): array
    {
        return [
            '/coveralls/c/github/jekyll/jekyll'           => 'coverage (github)',
            '/coveralls/c/github/jekyll/jekyll/master'    => 'coverage (github, branch)',
            '/coveralls/c/bitbucket/pyKLIP/pyklip'        => 'coverage (bitbucket)',
            '/coveralls/c/bitbucket/pyKLIP/pyklip/master' => 'coverage (bitbucket, branch)',
        ];
    }
}
