<?php

declare(strict_types=1);

namespace App\Integrations\PeerTube;

use Illuminate\Support\Facades\Http;

final class Client
{
    public function get(string $instance, string $path): array
    {
        return Http::baseUrl("https://{$instance}/api/v1")->get($path)->throw()->json();
    }
}
