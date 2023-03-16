<?php

declare(strict_types=1);

namespace App\Integrations\Docker;

use App\Integrations\Contracts\IntegrationProvider;
use Illuminate\Support\Facades\Route;

final class Provider implements IntegrationProvider
{
    public function name(): string
    {
        return 'Docker';
    }

    public function register(): void
    {
        Route::prefix('docker')->group(function (): void {
            Route::get('stars/{scope}/{name}', Controllers\StarsController::class);
            Route::get('pulls/{scope}/{name}', Controllers\PullsController::class);
            Route::get('size/{scope}/{name}/{tag?}/{architecture?}/{variant?}', Controllers\SizeController::class);
            Route::get('layers/{scope}/{name}/{tag?}/{architecture?}/{variant?}', Controllers\LayersController::class);
            Route::get('metadata/{type}/{scope}/{name}/{tag?}/{architecture?}/{variant?}', Controllers\MetadataController::class);
        });
    }

    public function examples(): array
    {
        return [
            '/docker/pulls/library/ubuntu'                                            => 'pulls (library)',
            '/docker/stars/library/ubuntu'                                            => 'stars (library)',
            '/docker/size/library/ubuntu'                                             => 'size (library)',
            '/docker/pulls/amio/node-chrome'                                          => 'pulls (scoped)',
            '/docker/stars/library/mongo?icon=docker&label=stars'                     => 'stars (icon & label)',
            '/docker/size/lukechilds/bitcoind/latest/amd64'                           => 'size (scoped/tag/architecture)',
            '/docker/size/lucashalbert/curl/latest/arm/v6'                            => 'size (scoped/tag/architecture/variant)',
            '/docker/layers/lucashalbert/curl/latest/arm/v7'                          => 'layers (size)',
            '/docker/layers/lucashalbert/curl/latest/arm/v7?icon=docker&label=layers' => 'layers (icon & label)',
            '/docker/layers/lucashalbert/curl/latest/arm/v7?label=docker%20layers'    => 'layers (label)',
            '/docker/metadata/version/lucashalbert/curl/latest/arm64/v8'              => 'metadata (version)',
            '/docker/metadata/architecture/lucashalbert/curl/latest/arm64/v8'         => 'metadata (architecture)',
            '/docker/metadata/build-date/lucashalbert/curl/latest/arm64/v8'           => 'metadata (build-date)',
            '/docker/metadata/maintainer/lucashalbert/curl/latest/arm64/v8'           => 'metadata (maintainer)',
        ];
    }
}
