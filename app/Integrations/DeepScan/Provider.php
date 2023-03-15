<?php

declare(strict_types=1);

namespace App\Integrations\DeepScan;

use App\Integrations\Contracts\IntegrationProvider;
use Illuminate\Support\Facades\Route;

final class Provider implements IntegrationProvider
{
    public function name(): string
    {
        return 'DeepScan';
    }

    public function register(): void
    {
        Route::prefix('deepscan')->group(function (): void {
            //
        });
    }

    public function examples(): array
    {
        return [
            // https://deepscan.io/dashboard/#view=project&tid=7382&pid=9494&bid=123838&subview=overview
            '/deepscan/grade/team/7382/project/9494/branch/123838' => 'grade',
            // https://deepscan.io/dashboard/#view=project&tid=279&pid=1302&bid=3514&subview=overview
            '/deepscan/grade/team/279/project/1302/branch/3514' => 'grade',
            // https://deepscan.io/dashboard/#view=project&tid=8527&pid=10741&bid=152550&subview=overview
            '/deepscan/grade/team/8527/project/10741/branch/152550' => 'grade',
            // https://deepscan.io/dashboard/#view=project&tid=8527&pid=10741&bid=152550&subview=overview
            '/deepscan/issues/team/8527/project/10741/branch/152550' => 'issues',
            // https://deepscan.io/dashboard/#view=project&tid=7382&pid=9494&bid=123838&subview=overview
            '/deepscan/issues/team/7382/project/9494/branch/123838' => 'issues',
            // https://deepscan.io/dashboard/#view=project&tid=8527&pid=10741&bid=152550&subview=overview
            '/deepscan/lines/team/8527/project/10741/branch/152550' => 'lines',
            // https://deepscan.io/dashboard/#view=project&tid=7382&pid=9494&bid=123838&subview=overview
            '/deepscan/lines/team/7382/project/9494/branch/123838' => 'lines',
        ];
    }
}
