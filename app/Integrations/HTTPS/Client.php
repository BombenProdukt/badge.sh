<?php

declare(strict_types=1);

namespace App\Integrations\HTTPS;

use Illuminate\Support\Facades\Http;

final class Client
{
    public function get(string $host, ?string $path): array
    {
        return Http::baseUrl($host)->get($path ?: '/')->json();
    }
}
