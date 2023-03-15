<?php

declare(strict_types=1);

namespace App\Integrations\DevRant;

use App\Integrations\Contracts\IntegrationProvider;
use App\Integrations\DevRant\Controllers\UserIdController;
use App\Integrations\DevRant\Controllers\UsernameController;
use Illuminate\Support\Facades\Route;

final class Provider implements IntegrationProvider
{
    public function name(): string
    {
        return 'devRant';
    }

    public function register(): void
    {
        Route::prefix('devrant')->group(function (): void {
            Route::get('score/{userId}', UserIdController::class)->whereNumber('userId');
            Route::get('score/{username}', UsernameController::class);
        });
    }

    public function examples(): array
    {
        return [
            '/devrant/score/22941?icon=devrant'   => 'score',
            '/devrant/score/Linuxxx?icon=devrant' => 'score',
        ];
    }
}
