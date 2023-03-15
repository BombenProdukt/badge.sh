<?php

declare(strict_types=1);

namespace App\Integrations\Packagist;

use App\Integrations\Contracts\IntegrationProvider;
use App\Integrations\Packagist\Controllers\DailyDownloadsController;
use App\Integrations\Packagist\Controllers\DependentsController;
use App\Integrations\Packagist\Controllers\FaversController;
use App\Integrations\Packagist\Controllers\GitHubForksController;
use App\Integrations\Packagist\Controllers\GitHubIssuesController;
use App\Integrations\Packagist\Controllers\GitHubStarsController;
use App\Integrations\Packagist\Controllers\GitHubWatchersController;
use App\Integrations\Packagist\Controllers\LanguageController;
use App\Integrations\Packagist\Controllers\LicenseController;
use App\Integrations\Packagist\Controllers\MonthlyDownloadsController;
use App\Integrations\Packagist\Controllers\NameController;
use App\Integrations\Packagist\Controllers\PhpVersionController;
use App\Integrations\Packagist\Controllers\SuggestersController;
use App\Integrations\Packagist\Controllers\TotalDownloadsController;
use App\Integrations\Packagist\Controllers\VersionController;
use Illuminate\Support\Facades\Route;

final class Provider implements IntegrationProvider
{
    public function name(): string
    {
        return 'Packagist';
    }

    public function register(): void
    {
        Route::prefix('packagist')->group(function (): void {
            Route::get('/dd/{vendor}/{package}', DailyDownloadsController::class);
            Route::get('/dependents/{vendor}/{package}', DependentsController::class);
            Route::get('/dm/{vendor}/{package}', MonthlyDownloadsController::class);
            Route::get('/dt/{vendor}/{package}', TotalDownloadsController::class);
            Route::get('/favers/{vendor}/{package}', FaversController::class);
            Route::get('/ghf/{vendor}/{package}', GitHubForksController::class);
            Route::get('/ghi/{vendor}/{package}', GitHubIssuesController::class);
            Route::get('/ghs/{vendor}/{package}', GitHubStarsController::class);
            Route::get('/ghw/{vendor}/{package}', GitHubWatchersController::class);
            Route::get('/lang/{vendor}/{package}', LanguageController::class);
            Route::get('/license/{vendor}/{package}/{channel?}', LicenseController::class);
            Route::get('/n/{vendor}/{package}', NameController::class);
            Route::get('/name/{vendor}/{package}', NameController::class);
            Route::get('/php/{vendor}/{package}/{channel?}', PhpVersionController::class);
            Route::get('/suggesters/{vendor}/{package}', SuggestersController::class);
            Route::get('/v/{vendor}/{package}/{channel?}', VersionController::class);
        });
    }

    public function examples(): array
    {
        return [
            '/packagist/v/monolog/monolog'          => 'version',
            '/packagist/v/monolog/monolog/pre'      => 'version (pre)',
            '/packagist/v/monolog/monolog/latest'   => 'version (latest)',
            '/packagist/dt/monolog/monolog'         => 'total downloads',
            '/packagist/dd/monolog/monolog'         => 'daily downloads',
            '/packagist/dm/monolog/monolog'         => 'monthly downloads',
            '/packagist/favers/monolog/monolog'     => 'favers',
            '/packagist/dependents/monolog/monolog' => 'dependents',
            '/packagist/suggesters/monolog/monolog' => 'suggesters',
            '/packagist/name/monolog/monolog'       => 'name',
            '/packagist/ghs/monolog/monolog'        => 'github stars',
            '/packagist/ghw/monolog/monolog'        => 'github watchers',
            '/packagist/ghf/monolog/monolog'        => 'github followers',
            '/packagist/ghi/monolog/monolog'        => 'github issues',
            '/packagist/lang/monolog/monolog'       => 'language',
            '/packagist/license/monolog/monolog'    => 'license',
            '/packagist/php/monolog/monolog'        => 'php',
        ];
    }
}
