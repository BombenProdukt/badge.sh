<?php

declare(strict_types=1);

namespace App\Badges\Conda;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

final class Client
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl('https://api.anaconda.org')->throw();
    }

    public function get(string $channel, string $pkg): array
    {
        return $this->client->get("package/{$channel}/{$pkg}")->json();
    }
}
