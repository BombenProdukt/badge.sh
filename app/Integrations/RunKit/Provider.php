<?php

declare(strict_types=1);

namespace App\Integrations\RunKit;

use App\Integrations\Contracts\IntegrationProvider;
use App\Integrations\RunKit\Controllers\NotebookController;
use Illuminate\Support\Facades\Route;

final class Provider implements IntegrationProvider
{
    public function name(): string
    {
        return 'RunKit';
    }

    public function register(): void
    {
        Route::prefix('runkit')->group(function (): void {
            Route::get('{owner}/{notebook}/{path}', NotebookController::class)->where('path', '.+');
        });
    }

    public function examples(): array
    {
        return [
            '/runkit/vladimyr/metaweather/44418/state'         => 'metaweather (state)',
            '/runkit/vladimyr/metaweather/44418/temperature'   => 'metaweather (temperature in °C)',
            '/runkit/vladimyr/metaweather/44418/temperature/f' => 'metaweather (temperature in °F)',
            '/runkit/vladimyr/metaweather/44418/wind'          => 'metaweather (wind in km/h)',
            '/runkit/vladimyr/metaweather/44418/wind/mph'      => 'metaweather (wind in mph)',
            '/runkit/vladimyr/metaweather/44418/humidity'      => 'metaweather (humidity)',
        ];
    }
}
