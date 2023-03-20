<?php

declare(strict_types=1);

namespace App\Badges\Bit;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

final class Client
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl('https://api.bit.dev/')->throw();
    }

    public function get(string $collection): array
    {
        return $this->client->get("scope/{$collection}")->json('payload');
    }
}
