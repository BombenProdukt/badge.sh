<?php

declare(strict_types=1);

namespace App\Integrations\Codacy;

use App\Integrations\Codacy\Controllers\CoverageController;
use App\Integrations\Codacy\Controllers\GradeController;
use App\Integrations\Contracts\IntegrationProvider;
use Illuminate\Support\Facades\Route;

final class Provider implements IntegrationProvider
{
    public function name(): string
    {
        return 'Codacy';
    }

    public function register(): void
    {
        Route::prefix('codacy')->group(function (): void {
            Route::get('coverage/{projectId}/{branch?}', CoverageController::class);
            Route::get('grade/{projectId}/{branch?}', GradeController::class);
        });
    }

    public function examples(): array
    {
        return [
            // f0875490cea1497a9eca9c25f3f7774e → https://github.com/xobotyi/react-scrollbars-custom
            '/codacy/coverage/f0875490cea1497a9eca9c25f3f7774e'        => 'coverage',
            '/codacy/coverage/f0875490cea1497a9eca9c25f3f7774e/master' => 'branch coverage',
            '/codacy/grade/f0875490cea1497a9eca9c25f3f7774e'           => 'code quality',
            '/codacy/grade/f0875490cea1497a9eca9c25f3f7774e/master'    => 'branch code quality',
        ];
    }
}
