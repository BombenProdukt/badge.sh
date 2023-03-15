<?php

declare(strict_types=1);

namespace App\Integrations\Jenkins;

use App\Integrations\Contracts\IntegrationProvider;
use Illuminate\Support\Facades\Route;

final class Provider implements IntegrationProvider
{
    public function name(): string
    {
        return 'Jenkins';
    }

    public function register(): void
    {
        Route::prefix('jenkins')->group(function (): void {
            //
        });
    }

    public function examples(): array
    {
        return [
            '/jenkins/last-build/jenkins.mono-project.com/job/test-mono-mainline/'   => 'Last build status',
            '/jenkins/fix-time/jenkins.mono-project.com/job/test-mono-mainline/'     => 'Time taken to fix a broken build',
            '/jenkins/broken-build/jenkins.mono-project.com/job/test-mono-mainline/' => '# of broken builds',
        ];
    }
}
