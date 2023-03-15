<?php

declare(strict_types=1);

namespace App\Integrations\Homebrew;

use App\Integrations\Contracts\IntegrationProvider;
use Illuminate\Support\Facades\Route;

final class Provider implements IntegrationProvider
{
    public function name(): string
    {
        return 'Homebrew';
    }

    public function register(): void
    {
        Route::prefix('homebrew')->group(function (): void {
            //
        });
    }

    public function examples(): array
    {
        return [
            '/homebrew/v/fish'            => 'version',
            '/homebrew/v/cake'            => 'version',
            '/homebrew/dm/fish'           => 'monthly downloads',
            '/homebrew/dy/fish'           => 'yearly downloads',
            '/homebrew/cask/v/atom'       => 'version',
            '/homebrew/cask/v/whichspace' => 'version',
            '/homebrew/cask/dm/atom'      => 'monthly downloads',
            '/homebrew/cask/dy/atom'      => 'yearly downloads',
        ];
    }
}
