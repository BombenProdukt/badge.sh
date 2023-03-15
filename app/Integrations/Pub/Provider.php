<?php

declare(strict_types=1);

namespace App\Integrations\Pub;

use App\Integrations\Contracts\IntegrationProvider;
use Closure;
use Illuminate\Support\Facades\Route;

final class Provider implements IntegrationProvider
{
    public function name(): string
    {
        return 'Dart packages';
    }

    public function register(): void
    {
        Route::prefix('dart')->group($this->routes());

        // Backwards compatibility with old badge URLs!
        Route::prefix('pub')->group($this->routes());
    }

    public function examples(): array
    {
        return [
            '/pub/v/kt_dart'                    => 'version',
            '/pub/v/mobx'                       => 'version',
            '/pub/license/pubx'                 => 'license',
            '/pub/likes/firebase_core'          => 'likes',
            '/pub/points/rxdart'                => 'pub points',
            '/pub/popularity/mobx'              => 'popularity',
            '/pub/sdk-version/uuid'             => 'sdk-version',
            '/pub/dart-platform/rxdart'         => 'dart-platform',
            '/pub/dart-platform/google_sign_in' => 'dart-platform',
            '/pub/flutter-platform/xml'         => 'flutter-platform',
        ];
    }

    private function routes(): Closure
    {
        return function (): void {
            Route::get('{shardbox}', 'ShardboxController@show');
        };
    }
}
