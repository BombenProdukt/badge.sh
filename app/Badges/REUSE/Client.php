<?php

declare(strict_types=1);

namespace App\Badges\REUSE;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

final class Client
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl('https://api.reuse.software')->throw();
    }

    public function get(string $remote): array
    {
        return $this->client->get("status/{$remote}")->json();
    }
}
