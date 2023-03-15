<?php

declare(strict_types=1);

namespace App\Integrations\Haxelib;

use App\Integrations\Contracts\IntegrationProvider;
use Illuminate\Support\Facades\Route;

final class Provider implements IntegrationProvider
{
    public function name(): string
    {
        return 'Haxelib';
    }

    public function register(): void
    {
        Route::prefix('haxelib')->group(function (): void {
            //
        });
    }

    public function examples(): array
    {
        return [
            '/haxelib/v/tink_http'    => 'version',
            '/haxelib/v/nme'          => 'version',
            '/haxelib/d/hxnodejs'     => 'downloads',
            '/haxelib/dl/hxnodejs'    => 'downloads (latest version)',
            '/haxelib/license/openfl' => 'license',
        ];
    }
}
