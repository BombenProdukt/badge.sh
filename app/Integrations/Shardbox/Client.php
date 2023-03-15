<?php

declare(strict_types=1);

namespace App\Integrations\Shardbox;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

final class Client
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl('https://shardbox.org/')->throw();
    }

    public function get(string $package): string
    {
        return $this->client->get("shards/{$package}")->body();
    }
}
