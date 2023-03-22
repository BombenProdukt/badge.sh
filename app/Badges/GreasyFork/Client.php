<?php

declare(strict_types=1);

namespace App\Badges\GreasyFork;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

final class Client
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl('https://greasyfork.org')->throw();
    }

    public function get(string $scriptId): array
    {
        return $this->client->get("scripts/{$scriptId}.json")->json();
    }
}
