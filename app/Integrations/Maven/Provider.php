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
            //
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
