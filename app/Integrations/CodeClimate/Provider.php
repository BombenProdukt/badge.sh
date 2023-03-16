<?php

declare(strict_types=1);

namespace App\Integrations\CodeClimate;

use App\Integrations\CodeClimate\Controllers\CoverageController;
use App\Integrations\CodeClimate\Controllers\CoverageLetterController;
use App\Integrations\CodeClimate\Controllers\IssuesController;
use App\Integrations\CodeClimate\Controllers\LocController;
use App\Integrations\CodeClimate\Controllers\MaintainabilityController;
use App\Integrations\CodeClimate\Controllers\MaintainabilityPercentageController;
use App\Integrations\CodeClimate\Controllers\TechDebtController;
use App\Integrations\Contracts\IntegrationProvider;
use Illuminate\Support\Facades\Route;

final class Provider implements IntegrationProvider
{
    public function name(): string
    {
        return 'Code Climate';
    }

    public function register(): void
    {
        Route::prefix('codeclimate')->group(function (): void {
            Route::get('loc/{owner}/{repo}', LocController::class);
            Route::get('issues/{owner}/{repo}', IssuesController::class);
            Route::get('tech-debt/{owner}/{repo}', TechDebtController::class);
            Route::get('maintainability/{owner}/{repo}', MaintainabilityController::class);
            Route::get('maintainability-percentage/{owner}/{repo}', MaintainabilityPercentageController::class);
            Route::get('coverage-letter/{owner}/{repo}', CoverageLetterController::class);
            Route::get('coverage/{owner}/{repo}', CoverageController::class);
        });
    }

    public function examples(): array
    {
        return [
            '/codeclimate/loc/codeclimate/codeclimate'                        => 'lines of code',
            '/codeclimate/issues/codeclimate/codeclimate'                     => 'issues',
            '/codeclimate/tech-debt/codeclimate/codeclimate'                  => 'technical debt',
            '/codeclimate/maintainability/codeclimate/codeclimate'            => 'maintainability',
            '/codeclimate/maintainability-percentage/codeclimate/codeclimate' => 'maintainability (percentage)',
            '/codeclimate/coverage/codeclimate/codeclimate'                   => 'coverage',
            '/codeclimate/coverage-letter/codeclimate/codeclimate'            => 'coverage (letter)',
        ];
    }
}
