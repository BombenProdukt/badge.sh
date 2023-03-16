<?php

declare(strict_types=1);

namespace App\Integrations\OhDear;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Http;

final class Client extends Controller
{
    public function get(string $domain): array
    {
        return Http::get("https://{$domain}/json")->throw()->json();
    }
}
