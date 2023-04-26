<?php

declare(strict_types=1);

namespace App\Badges\Bundlephobia;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

final class Client
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl('https://bundlephobia.com/api/')->throw();
    }

    public function get(string $package): array
    {
        return $this->client->get('size', ['package' => $package])->json();
    }
}
