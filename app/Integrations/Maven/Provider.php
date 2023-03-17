<?php

declare(strict_types=1);

namespace App\Integrations\Maven;

use App\Integrations\Contracts\IntegrationProvider;
use Illuminate\Support\Facades\Route;

final class Provider implements IntegrationProvider
{
    public function name(): string
    {
        return 'Maven';
    }

    public function register(): void
    {
        Route::prefix('maven')->group(function (): void {
            Route::get('/v/{repo}/{group}/{artifact}', Controllers\RepoController::class)
                ->whereIn('repo', ['maven-central', 'jcenter'])
                ->where('pathname', '.+');

            Route::get('/v/metadata-url/{protocol}/{hostname}/{pathname}', Controllers\UrlWithProtocolController::class)
                ->where('protocol', 'https?:?')
                ->where('pathname', '.+');

            Route::get('/v/metadata-url/{hostname}/{pathname}', Controllers\UrlController::class)
                ->where('pathname', '.+');
        });
    }

    public function examples(): array
    {
        return [
            '/maven/v/maven-central/com.google.code.gson/gson'                                                => 'version (maven-central)',
            '/maven/v/jcenter/com.squareup.okhttp3/okhttp'                                                    => 'version (jcenter)',
            '/maven/v/metadata-url/https/repo1.maven.org/maven2/com/google/code/gson/gson/maven-metadata.xml' => 'version (maven metadata url)',
            '/maven/v/metadata-url/repo1.maven.org/maven2/com/google/code/gson/gson/maven-metadata.xml'       => 'version (maven metadata url)',
        ];
    }
}
