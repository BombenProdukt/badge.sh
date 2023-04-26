<?php

declare(strict_types=1);

namespace App\Badges\JSDelivr;

use Illuminate\Support\Facades\Http;

final class Client
{
    public function data(string $type, string $name): array
    {
        return Http::baseUrl('https://data.jsdelivr.com/v1')
            ->throw()
            ->get("package/{$type}/{$name}/stats")
            ->json();
    }

    public function cdn(string $name): array
    {
        return Http::baseUrl('https://cdn.jsdelivr.net/')
            ->throw()
            ->get("npm/{$name}/package.json")
            ->json();
    }
}
