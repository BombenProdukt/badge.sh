<?php

declare(strict_types=1);

namespace App\Integrations\Pub;

use App\Integrations\Contracts\IntegrationProvider;
use App\Integrations\Pub\Controllers\DartPlatformController;
use App\Integrations\Pub\Controllers\FlutterPlatformController;
use App\Integrations\Pub\Controllers\LicenseController;
use App\Integrations\Pub\Controllers\LikesController;
use App\Integrations\Pub\Controllers\PointsController;
use App\Integrations\Pub\Controllers\PopularityController;
use App\Integrations\Pub\Controllers\SdkVersionController;
use App\Integrations\Pub\Controllers\VersionController;
use Illuminate\Support\Facades\Route;

final class Provider implements IntegrationProvider
{
    public function name(): string
    {
        return 'Dart packages';
    }

    public function register(): void
    {
        Route::prefix('pub')->group(function (): void {
            Route::get('v/{package}', VersionController::class);
            Route::get('version/{package}', VersionController::class);
            Route::get('sdk-version/{package}', SdkVersionController::class);
            Route::get('likes/{package}', LikesController::class);
            Route::get('points/{package}', PointsController::class);
            Route::get('popularity/{package}', PopularityController::class);
            Route::get('dart-platform/{package}', DartPlatformController::class);
            Route::get('flutter-platform/{package}', FlutterPlatformController::class);
            Route::get('license/{package}', LicenseController::class);
        });
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
}
