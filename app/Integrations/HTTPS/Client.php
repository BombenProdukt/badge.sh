<?php

declare(strict_types=1);

namespace App\Integrations\HTTPS;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Http;

final class Client extends Controller
{
    public function get(string $host, ?string $path): array
    {
        return Http::baseUrl($host)->get($path ?: '/')->json();
    }
}
