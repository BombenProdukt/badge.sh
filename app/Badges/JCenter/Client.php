<?php

declare(strict_types=1);

namespace App\Badges\JCenter;

use Illuminate\Support\Facades\Http;

final class Client
{
    public function get(string $path): string
    {
        return Http::baseUrl('https://jcenter.bintray.com/')->throw()->get($path)->body();
    }
}
