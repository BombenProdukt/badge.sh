<?php

declare(strict_types=1);

namespace App\Badges\HexPM;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

final class Client
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl('https://hex.pm/api')->throw();
    }

    public function get(string $packageName): array
    {
        return $this->client->get("packages/{$packageName}")->json();
    }
}
