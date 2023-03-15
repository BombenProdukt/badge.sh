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
            //
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
