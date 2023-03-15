<?php

declare(strict_types=1);

namespace App\Integrations\CircleCI;

use App\Integrations\CircleCI\Controllers\StatusController;
use App\Integrations\Contracts\IntegrationProvider;
use Illuminate\Support\Facades\Route;

final class Provider implements IntegrationProvider
{
    public function name(): string
    {
        return 'CircleCI';
    }

    public function register(): void
    {
        Route::prefix('circleci')->group(function (): void {
            Route::get('/{vcs}/{owner}/{repo}/{branch?}', StatusController::class)->whereIn('vcs', ['github', 'gitlab']);
        });
    }

    public function examples(): array
    {
        return [
            '/circleci/github/nuxt/nuxt.js'        => 'build',
            '/circleci/github/nuxt/nuxt.js/master' => 'build (branch)',
        ];
    }
}
