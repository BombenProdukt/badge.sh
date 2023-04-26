<?php

declare(strict_types=1);

namespace App\Badges\Liberapay;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

final class Client
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl('https://liberapay.com/')->throw();
    }

    public function get(string $username): array
    {
        return $this->client->get("{$username}/public.json")->json();
    }
}
