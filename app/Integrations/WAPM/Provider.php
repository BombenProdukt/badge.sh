<?php

declare(strict_types=1);

namespace App\Integrations\WAPM;

use App\Integrations\Contracts\IntegrationProvider;
use Illuminate\Support\Facades\Route;

final class Provider implements IntegrationProvider
{
    public function name(): string
    {
        return 'wapm';
    }

    public function register(): void
    {
        Route::prefix('wapm')->group(function (): void {
            //
        });
    }

    public function examples(): array
    {
        return [
            '/wapm/v/zamfofex/greg'         => 'version',
            '/wapm/v/cowsay'                => 'version',
            '/wapm/license/huhn/hello-wasm' => 'license',
            '/wapm/size/coreutils'          => 'size',
            '/wapm/abi/jwmerrill/lox-repl'  => 'abi',
            '/wapm/abi/kherrick/pwgen'      => 'abi',
        ];
    }
}
