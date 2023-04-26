<?php

declare(strict_types=1);

namespace App\Badges\Mastodon;

use Illuminate\Support\Facades\Http;

final class Client
{
    public function get(string $instance, string $path): array
    {
        return Http::baseUrl("https://{$instance}/api/v1/")
            ->get($path)
            ->throw()
            ->json();
    }

    public function rss(string $instance, string $username): string
    {
        return Http::baseUrl("https://{$instance}/")
            ->get("@{$username}.rss")
            ->throw()
            ->body();
    }
}
