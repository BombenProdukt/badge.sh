<?php

declare(strict_types=1);

namespace App\Badges\Coincap;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

final class Client
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl('https://api.coincap.io/v2')->throw();
    }

    public function get(string $assetId): array
    {
        return $this->client->get("assets/{$assetId}")->json('data');
    }
}
