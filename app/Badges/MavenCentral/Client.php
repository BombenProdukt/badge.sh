<?php

declare(strict_types=1);

namespace App\Badges\MavenCentral;

use Illuminate\Support\Facades\Http;

final class Client
{
    public function get(string $path): string
    {
        return Http::baseUrl('https://repo1.maven.org/maven2/')->throw()->get($path)->body();
    }
}
