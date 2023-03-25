<?php

declare(strict_types=1);

namespace App\Badges\W3C;

use Illuminate\Support\Facades\Http;

final class Client
{
    public function get(string $targetUrl)
    {
        return Http::get('https://validator.w3.org/nu/?doc='.\urlencode($targetUrl).'&out=json')->throw()->json();
    }
}
