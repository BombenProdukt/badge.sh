<?php

declare(strict_types=1);

namespace App\Integrations\CTAN;

use Illuminate\Support\Facades\Http;

final class Client
{
    public function api(string $package): array
    {
        return Http::baseUrl('https://ctan.org/json/2.0/')->throw()->get("pkg/{$package}")->json();
    }

    public function web(string $package): string
    {
        return Http::baseUrl('https://ctan.org/')->throw()->get('vote/ajaxSummary', ['pkg' => $package])->body();
    }
}
