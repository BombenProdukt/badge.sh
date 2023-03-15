<?php

declare(strict_types=1);

namespace App\Integrations\Badgesize;

use App\Integrations\Contracts\IntegrationProvider;
use Illuminate\Support\Facades\Route;

final class Provider implements IntegrationProvider
{
    public function name(): string
    {
        return 'Badgesize';
    }

    public function register(): void
    {
        Route::prefix('badgesize')->group(function (): void {
            //
        });
    }

    public function examples(): array
    {
        return [
            '/badgesize/normal/amio/emoji.json/master/emoji-compact.json'            => 'normal size',
            '/badgesize/gzip/amio/emoji.json/master/emoji-compact.json'              => 'gzip size',
            '/badgesize/brotli/amio/emoji.json/master/emoji-compact.json'            => 'brotli size',
            '/badgesize/normal/file-url/https/unpkg.com/snarkdown/dist/snarkdown.js' => 'arbitrary url',
            '/badgesize/normal/file-url/unpkg.com/snarkdown/dist/snarkdown.js'       => 'arbitrary url',
        ];
    }
}
