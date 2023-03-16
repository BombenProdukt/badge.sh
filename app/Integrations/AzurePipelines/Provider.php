<?php

declare(strict_types=1);

namespace App\Integrations\AzurePipelines;

use App\Integrations\Contracts\IntegrationProvider;
use Illuminate\Support\Facades\Route;

final class Provider implements IntegrationProvider
{
    public function name(): string
    {
        return 'Azure Pipelines';
    }

    public function register(): void
    {
        Route::prefix('azure-pipelines')->group(function (): void {
            Route::get('build/status/{org}/{project}/{definition}/{branch?}', Controllers\BuildStatusController::class);
            Route::get('build/version/{org}/{project}/{definition}/{branch?}', Controllers\BuildVersionController::class);
            Route::get('build/test/{org}/{project}/{definition}/{branch?}', Controllers\BuildTestResultController::class);
            Route::get('release/version/{org}/{project}/{definition}/{environment?}', Controllers\ReleaseController::class);
            Route::get('deployment/version/{org}/{project}/{definition}/{environment?}', Controllers\DeploymentController::class);
            Route::get('{org}/{project}/{definition}/{branch?}', Controllers\StatusController::class);
        });
    }

    public function examples(): array
    {
        return [
            '/azure-pipelines/dnceng/public/efcore-ci'                                            => 'pipeline status (definition name)',
            '/azure-pipelines/dnceng/public/51'                                                   => 'pipeline status (definition id)',
            '/azure-pipelines/build/status/dnceng/public/51'                                      => 'build status',
            '/azure-pipelines/build/version/dnceng/public/51'                                     => 'build version',
            '/azure-pipelines/build/test/dnceng/public/51'                                        => 'test results',
            '/azure-pipelines/build/test/azuredevops-powershell/azuredevops-powershell/1'         => 'test results',
            '/azure-pipelines/release/version/azuredevops-powershell/azuredevops-powershell/1'    => 'release version',
            '/azure-pipelines/deployment/version/azuredevops-powershell/azuredevops-powershell/1' => 'deployment version',
        ];
    }
}
