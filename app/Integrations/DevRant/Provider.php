<?php

declare(strict_types=1);

namespace App\Integrations\DevRant;

use App\Integrations\Contracts\IntegrationProvider;
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
            //
        });
    }

    public function examples(): array
    {
        return [
            '/devrant/score/22941?icon=devrant'   => 'score',
            '/devrant/score/Tooma95?icon=devrant' => 'score',
        ];
    }
}
