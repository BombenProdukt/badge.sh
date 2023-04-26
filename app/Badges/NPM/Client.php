<?php

declare(strict_types=1);

namespace App\Badges\NPM;

use Illuminate\Support\Facades\Http;

final class Client
{
    public function registry(string $package): array
    {
        return Http::baseUrl('https://registry.npmjs.org')->throw()->get($package)->json();
    }

    public function api(string $package): array
    {
        return Http::baseUrl('https://api.npmjs.org/')->throw()->get($package)->json();
    }

    public function web(string $package): string
    {
        return Http::baseUrl('https://www.npmjs.com/')->throw()->get($package)->body();
    }

    public function unpkg(string $package): array
    {
        return Http::baseUrl('https://unpkg.com/')->throw()->get($package)->json();
    }
}
