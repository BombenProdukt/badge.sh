<?php

declare(strict_types=1);

namespace App\Integrations\Matrix;

use App\Integrations\Contracts\IntegrationProvider;
use App\Integrations\DeprecatedController;
use Illuminate\Support\Facades\Route;

final class Provider implements IntegrationProvider
{
    public function name(): string
    {
        return 'Matrix';
    }

    public function register(): void
    {
        Route::prefix('matrix')->group(function (): void {
            Route::get('members/{room}/gitter', DeprecatedController::class);
            Route::get('members/{room}/gitter.im', DeprecatedController::class);
            Route::get('members/{room}/{server?}', Controllers\MemberController::class);
        });
    }

    public function examples(): array
    {
        return [
            '/matrix/members/rust/matrix.org'         => 'members',
            '/matrix/members/thisweekinmatrix'        => 'members',
            '/matrix/members/archlinux/archlinux.org' => 'members',
            '/matrix/members/redom_redom/gitter.im'   => 'members',
        ];
    }
}
