<?php

declare(strict_types=1);

namespace App\Integrations\Pub;

use Illuminate\Support\Facades\Http;

final class Client
{
    public function api(string $package): array
    {
        return Http::baseUrl('https://pub.dev/api/')
            ->get($package)
            ->throw()
            ->json();
    }

    public function web(string $package): string
    {
        return Http::baseUrl('https://pub.dev/')
            ->withoutRedirecting()
            ->get($package)
            ->throw()
            ->body();
    }
}
